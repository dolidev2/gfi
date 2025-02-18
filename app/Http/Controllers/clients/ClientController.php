<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\ClientAddRequest;
use App\Http\Requests\clients\ClientEditRequest;
use App\Models\Agence;
use App\Models\client;
use App\Models\Commande;
use App\Models\commande_modele_tissu;
use App\Models\feedback_client;
use App\Models\Mesure;
use App\Models\modele;
use App\Models\report_rdv;
use App\Models\Tissu;
use App\Models\TissuImage;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ClientHelper;

class ClientController extends Controller
{
    public function getNumberOfMesure()
    {
        //Numero de mesure
        $debut = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-01-01 00:00:00');
        $fin = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-12-31 23:59:59');
        $client = Client::where('created_at', '>=', $debut)
            ->orWhere('created_at', 'like', '%'.$fin.'%')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();
        if ( isset($client) && $client->count() > 0 ) {
            $num = explode('-',$client[0]['matricule']);
            $matricule = 'GFI-'.($num[1]+1).'-'.date('Y');
        }else{
            $matricule = 'GFI-1-'.date('Y');
        }

        return $matricule;
    }
    public function getNumberOfCommande()
    {
        //Numero de commande
        $debut = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-01-01 00:00:00');
        $fin = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-12-31 23:59:59');
        $commande = Commande::where('created_at', '>=', $debut)
            ->orWhere('created_at', 'like', '%'.$fin.'%')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();
        if ( isset($commande) && $commande->count() > 0 ) {
            $num = explode('-',$commande[0]['numero_commande']);
            $numero = 'GFI-CMD-'.($num[2]+1).'-'.date('Y');
        }else{
            $numero = 'GFI-CMD-1-'.date('Y');
        }

        return $numero;
    }

    public function getTotalOfCommande($commande){
        $composition = commande_modele_tissu::where('commande_id', $commande->id)->get();
        $total = 0;
        foreach ($composition as $obj) {

            $total += $obj->prix_modele * $obj->quantite;
            if($obj->remise != null){
                $total -= $obj->remise;
            }
        }
        return $total;
    }

    public function home ()
    {
        $clients = client::all();
        $id = Auth::user()->id;
        return view ('pages.client.home', compact ('clients'));
    }

    public function add()
    {
        $clients = client::all();
        $agences = Agence::all ();

      $matricule = $this->getNumberOfMesure();
        return view ('pages.client.add', compact ('clients', 'agences', 'matricule'));
    }

    public function store (ClientAddRequest $request)
    {
        try
        {
            $client = new client ();
            $client->nom_complet = $request->nom;
            $client->contact = $request->contact;
            $client->adresse = $request->adresse;
            $client->matricule = $request->matricule;
            $client->matricule = $request->matricule;
            $client->created_at = $request->date_arrive;
            if (isset($request->agence)){
                $client->agence_id = $request->agence;
            }
            else{
                $user = Auth::user ()->id;
                $client->agence_id = $user->agence_id;
            }

            if(isset($request->bpostale)){
                $client->boite_postale = $request->bpostale;
            }
            if (isset($request->ifu)){
                $client->ifu = $request->ifu;
            }
            if (isset($request->rccm)){
                $client->rccm = $request->rccm;
            }
            if (isset($request->dfiscale)){
                $client->division_fiscale = $request->dfiscale;
            }
            if (isset($request->rimposition)){
                $client->regime_imposition = $request->rimposition;
            }
            if(isset($request->client) && !empty($request->client) ){
                $client->client = $request->client;
            }
            $photoProfil = $request->file('photoProfile');
            if(isset($photoProfil) && !empty($photoProfil)){

                $photoProfilName = time().'.'.$photoProfil->getClientOriginalExtension();
                $photoProfil->move(public_path('images/clients'),$photoProfilName);
                $client->image = $photoProfilName;
            }

            $client->save ();
            alert()->success('Ajout','Client ajouté avec succès');

            return redirect()->route('clients.list'); //Redirect to clients list page

        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());

            return redirect()->route('clients.add');// Redirect to clients add page
        }

    }

    public function edit($id)
    {
        $client = client::find($id);
        $client->agence = Agence::find($client->agence_id);
        $clients = client::all();
        $agences = Agence::all();

        return view ('pages.client.edit', compact ('client', 'agences', 'clients'));
    }

    public function update (ClientEditRequest $request)
    {
        try
        {
            $client = client::find($request->client_id);
            $client->nom_complet = $request->nom;
            $client->contact = $request->contact;
            $client->adresse = $request->adresse;
            $client->matricule = $request->matricule;
            $client->updated_at = $request->date_arrive;
            if (isset($request->agence)){
                $client->agence_id = $request->agence;
            }
            else{
                $user = Auth::user ()->user_id;
                $client->agence_id = $user->agence_id;
            }

            if(isset($request->bpostale)){
                $client->boite_postale = $request->bpostale;
            }
            if (isset($request->ifu)){
                $client->ifu = $request->ifu;
            }
            if (isset($request->rccm)){
                $client->rccm = $request->rccm;
            }
            if (isset($request->dfiscale)){
                $client->division_fiscale = $request->dfiscale;
            }
            if (isset($request->rimposition)){
                $client->regime_imposition = $request->rimposition;
            }
            if(isset($request->client) && !empty($request->client) ){
                $client->client = $request->client;
            }
            $photoProfil = $request->file('photoProfile');
            if(isset($photoProfil) && !empty($photoProfil)){
                //Delete old cnib_recto
                if( file_exists (public_path('images/clients'.$client->image)) ){
                    try {
                        unlink(public_path('images/clients'.$client->image));
                    }catch (\Exception $e){

                    }
                }
                $photoProfilName = time().'.'.$photoProfil->getClientOriginalExtension();
                $photoProfil->move(public_path('images/clients'),$photoProfilName);
                $client->image = $photoProfilName;
            }

            $client->save ();
            alert()->success('Modification','Client modifié avec succès');

            return redirect()->route('clients.list'); //Redirect to clients list page

        }catch (\Exception $e){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());

        }
    }

    public function view ($id)
    {
        $client = client::find($id);
        $mesure = Mesure::where('client_id', $id)->get();
        $tissus = Tissu::where('client_id', $id)->get();
        $remarques = feedback_client::where('client_id', $id)->get();
        $remarques->each(function($remarque) {
            $remarque->commande = Commande::find($remarque->commande_id);
        });
        $tissus->each(function($tissu){
            $tissu->images = TissuImage::where('tissu_id', $tissu->id)->get();
        });
        $commandes = Commande::where('client_id', $id)->get();
        $commandes->each(function($commande){
            $commande->total = $this->getTotalOfCommande($commande);
            $commande->reports = report_rdv::where('commande_id', $commande->id)->get();
        });

        $numeroCommande = $this->getNumberOfCommande();

        return view ('pages.client.view', compact ('client','mesure', 'tissus','commandes', 'numeroCommande','remarques'));
    }


    public function delete ($id)
    {
        try {
            $client = client::find(intval($id));
            $client->delete();
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }


    public function statistique ($id)
    {
        $client = client::find($id);

        return view ('pages.client.statistique.home', compact ('client'));

    }
}
