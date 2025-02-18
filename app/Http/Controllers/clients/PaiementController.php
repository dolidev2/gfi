<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\commandes\paiement\PaiementAddRequest;
use App\Http\Requests\clients\commandes\paiement\PaiementEditRequest;
use App\Models\Agence;
use App\Models\Caisse;
use App\Models\client;
use App\Models\Commande;
use App\Models\commande_modele_tissu;
use App\Models\modele;
use App\Models\paiement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{

    public function getNumeroPaiement(){
        //Numero de paiement
        $debut = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-01-01 00:00:00');
        $fin = \DateTimeImmutable::createFromFormat('Y-m-d', date("Y") . '-12-31 23:59:59');
        $paiement = paiement::where('created_at', '>=', $debut)
            ->orWhere('created_at', 'like', '%'.$fin.'%')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get();
        if ( isset($paiement) && $paiement->count() > 0 ) {
            $num = explode('-',$paiement[0]['numero_paiement']);
            $numero = env('CODE_PAIEMENT').$num[2].'-'.date('Y');
        }else{
            $numero = env('CODE_PAIEMENT').'1-'.date('Y');
        }
        return $numero;
    }

    public function getTotalCommande($commande){
        try {
            //Calcul du total des paiements
            $composition = commande_modele_tissu::where('commande_id', $commande)->get();
            $total = 0;
            foreach ($composition as $obj) {
                $modele = modele::find($obj->modele_id);
                $total += $modele->prix * $obj->quantite;
                if($obj->remise != null){
                    $total -= $obj->remise;
                }
            }
            return $total;
        }catch (\Exception $e){

            return $e;
        }

    }

    public function getTotalVersement($commande){
        try {
            //Somme des paiements
            $paiements = paiement::where('commande_id', $commande)->get();
            $total = 0;
            foreach ($paiements as $paiement) {
                $total += $paiement->montant;
            }
            return $total;
        }catch (\Exception $e){

            return $e;
        }
    }

    public function getTotalPaiement($commande, $montant, $paiement){

        //Calcul du total des paiements
        $composition = commande_modele_tissu::where('commande_id', $commande)->get();
        $total = 0;
        foreach ($composition as $obj) {
            $modele = modele::find($obj->modele_id);
            $total += $modele->prix * $obj->quantite;
            if($obj->remise != null){
                $total -= $obj->remise;
            }
        }
        //verification s'il y a un paiement
        if($paiement != null){
            $paie = paiement::find($paiement);
            if($paie->montant < $montant){
                $totalPaiement = $montant - $paie->montant;
            }
        }else{
            $totalPaiement = $montant;
        }
        //Somme des paiements
        $paiements = paiement::where('commande_id', $commande)->get();
        foreach ($paiements as $paiement) {
            $totalPaiement += $paiement->montant;
        }

        if($totalPaiement >= $total){
            return true;
        }
        else{
            return false;
        }
    }

    public function view($client, $id)
    {
        $client = client::find($client);
        $commande = Commande::find($id);
        $paiements = paiement::where('commande_id', $id)->get();

        return view ('pages.client.commande.paiement.view', compact ('client', 'commande', 'paiements'));
    }

    public function store(PaiementAddRequest $request){
        try {

            //Verification si le paiement existe déjà
            $solde = $this->getTotalPaiement($request->commande_id, $request->montant, null);
            if($solde){
                alert()->warning('Erreur','Les montants versés sont supérieurs  au total de la commande');
                return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id_cmd, 'id'=> $request->commande_id]); //Redirect to clients list page
            }
            else{
                //Store data in caisse
                $commande = Commande::find($request->commande_id);
                $id_user = Auth::user ()->id;
                $user = User::find($id_user);
                $caisse = new Caisse();
                $caisse->montant = $request->montant;
                $caisse->mode_caisse = env('TYPE_CAISSE_ENTRE');
                $caisse->motif = "Versement de commande numéro ".$commande->numero_commande;
                $caisse->agence_id = $user->agence_id;
                $caisse->numero_caisse = $this->getNumeroPaiement();
                $caisse->save();

                $paiement = new paiement();
                $paiement->montant = $request->montant;
                $paiement->mode_paiement = $request->mode_paiement;
                $paiement->description = $request->description;
                $paiement->commande_id = $request->commande_id;

                $date_creation = explode('/',$request->date_paiement);
                $paiement->created_at = date('Y-m-d', strtotime($date_creation[2].'-'.$date_creation[1].'-'.$date_creation[0]));

                $paiement->numero_paiement = $caisse->numero_caisse;
                $paiement->caisse_id = $caisse->id;

                $paiement->save();
                alert()->warning('Ajout','Paiement ajouté avec succès');
                return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id, 'id'=> $request->commande_id]); //Redirect to clients list page
            }

        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());
            return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id, 'id'=> $request->commande_id]); //Redirect to clients list page
        }
    }

    public function update (PaiementEditRequest $request)
    {
        try {
            //Verification si le paiement existe déjà
            $solde = $this->getTotalPaiement($request->commande_id_up, $request->montant_up, $request->paiement_id);
            if($solde){
                alert()->warning('Erreur','Les montants versés sont supérieurs  au total de la commande');
                return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id_up, 'id'=> $request->commande_id_up]); //Redirect to clients list page
            }
            else{
                //Update paiement
                $paiement = paiement::find($request->paiement_id);
                $paiement->montant = $request->montant_up;
                $paiement->mode_paiement = $request->mode_paiement_up;
                $paiement->description = $request->description_up;

                $date_creation = explode('/',$request->date_paiement_up);
                $paiement->created_at = date('Y-m-d', strtotime($date_creation[2].'-'.$date_creation[1].'-'.$date_creation[0]));

                $paiement->save();

                //Update caisse
                $caisse = caisse::find($paiement->caisse_id);
                $caisse->montant = $request->montant_up;
                $caisse->updated_at = date('Y-m-d H:i:s');
                $caisse->save();
                alert()->warning('Modification','Paiement modifié avec succès');
                return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id_up, 'id'=> $request->commande_id_up]); //Redirect to clients list page
            }
        }catch (\Exception $e){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('client.commande.paiement.view',['client'=> $request->client_id_up, 'id'=> $request->commande_id_up]); //Redirect to clients list page
        }
    }

    public function delete($id){

        try {
            //Delete paiement
            $paiement = paiement::find($id);
            $caisse = caisse::find($paiement->caisse_id);

            $caisse->delete();
            $paiement->delete();

            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function print($client, $id){
        try {
            $paiement = paiement::find($id);
            $paiement->totalCommande = $this->getTotalCommande($paiement->commande_id);
            $paiement->totalVersement = $this->getTotalVersement($paiement->commande_id);
            $commande = Commande::find($paiement->commande_id);
            $client = client::find($commande->client_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template = view ('pages.client.commande.paiement.print', compact ('client', 'paiement', 'commande','agence', 'user'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('reçu-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');
        }catch (\Exception $e){
            Alert::error('print')->with('message', 'Echec de l\'impression');
            return redirect()->route('client.commande.paiement.view',['client'=> $client, 'id'=> $id]); //Redirect to clients list page
        }
    }

    public function printAll($client, $command){

        try {
            $paiements = paiement::where('commande_id', $command)->get();
            $commande = Commande::find($command);
            $commande->totalCommande = $this->getTotalCommande($command);
            $commande->totalVersement = $this->getTotalVersement($command);

            $client = client::find($commande->client_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $data = compact ('client', 'paiements', 'commande','agence', 'user');
            $template = view ('pages.client.commande.paiement.printAll', $data);
            $pdf = Pdf::loadHTML($template->render());
            return $pdf->stream('reçu-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');

        }catch (\Exception $e){
            echo '<pre>';
            print_r ($e->getMessage());
            echo '</pre>';
        }
    }

}
