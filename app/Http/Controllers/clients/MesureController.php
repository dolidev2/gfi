<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\mesures\MesureAddRequest;
use App\Http\Requests\clients\mesures\MesureEditRequest;
use App\Models\Agence;
use App\Models\client;
use App\Models\Mesure;
use App\Models\mesure_historique;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesureController extends Controller
{
    public function home (){
        $mesures = mesure::all();
        return view ('pages.client.mesure.home', compact ('mesures'));
    }

    public function add($id){
      $client = client::find($id);
        return view ('pages.client.mesure.add', compact ('client'));
    }

    public function store(MesureAddRequest $request){
        try {
            $mesureObj = mesure::where('client_id', $request->client_id)->first();
            if(isset($mesureObj)){
                alert()->success('Ajout','Mesure du client existe déjà');
                return redirect()->route('clients.view', ['id'=> $request->client_id]);
            }

            $mesure = new Mesure();
            $mesure->epaule = $request->epaule;
            $mesure->longueur_epaule = $request->longueur_epaule;
            $mesure->longueur_manche = $request->longueur_manche;
            $mesure->bas = $request->bas;
            $mesure->poitrine = $request->poitrine;
            $mesure->dos = $request->dos;
            $mesure->bassin = $request->bassin;
            $mesure->longueur_taille = $request->longueur_taille;
            $mesure->tour_genou = $request->tour_genou;
            $mesure->ceinture = $request->ceinture;
            $mesure->poignet = $request->poignet;
            $mesure->tour_taille = $request->tour_taille;
            $mesure->tour_manche = $request->tour_manche;
            $mesure->cole = $request->cole;
            $mesure->cuisse = $request->cuisse;
            $mesure->longueur_chemise = $request->longueur_chemise;
            $mesure->longueur_gilet = $request->longueur_gilet;
            $mesure->longueur_veste = $request->longueur_veste;
            $mesure->longueur_genou = $request->longueur_genou;
            $mesure->longueur_pantalon = $request->longueur_pantalon;
            $mesure->longueur_pantacourt = $request->longueur_pantacourt;
            $mesure->entre_jambe = $request->entre_jambe;
            $mesure->longueur_chemise_arabe = $request->longueur_chemise_arabe;
            $mesure->frappe = $request->frappe;
            $mesure->carrure = $request->carrure;
            if($request->sexe == env('SEXE_FEMININ'))
            {
                $mesure->ecart_pince_poitrine = $request->ecart_pince_poitrine;
                $mesure->longueur_jupe = $request->longueur_jupe;
                $mesure->longueur_robe = $request->longueur_robe;
                $mesure->longueur_poitrine = $request->longueur_poitrine;
                $mesure->longueur_haut = $request->longueur_haut;
            }
            $mesure->sexe = $request->sexe;
            $mesure->chapeau = $request->chapeau;
            $mesure->client_id = $request->client_id;
            $mesure->created_by =  Auth::user()->id;
            $mesure->updated_by = Auth::user()->id;
            $mesure->save();

            alert()->success('Ajout','Mesure ajoutée avec succès');
            return redirect()->route('clients.view', ['id'=> $request->client_id]); //Redirect to mesures list page

        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());

        }
    }

    public function edit($client, $id)
    {
        $mesure = mesure::find($id);
        $client = client::find($client);

        return view ('pages.client.mesure.edit', compact ('mesure','client'));
    }

    public function update (MesureEditRequest $request)
    {
        try
        {
            $mesure = mesure::find($request->mesure_id);
            $mesure->epaule = $request->epaule;
            $mesure->longueur_epaule = $request->longueur_epaule;
            $mesure->longueur_manche = $request->longueur_manche;
            $mesure->bas = $request->bas;
            $mesure->poitrine = $request->poitrine;
            $mesure->dos = $request->dos;
            $mesure->bassin = $request->bassin;
            $mesure->longueur_taille = $request->longueur_taille;
            $mesure->tour_genou = $request->tour_genou;
            $mesure->ceinture = $request->ceinture;
            $mesure->poignet = $request->poignet;
            $mesure->tour_taille = $request->tour_taille;
            $mesure->tour_manche = $request->tour_manche;
            $mesure->cole = $request->cole;
            $mesure->cuisse = $request->cuisse;
            $mesure->longueur_chemise = $request->longueur_chemise;
            $mesure->longueur_gilet = $request->longueur_gilet;
            $mesure->longueur_veste = $request->longueur_veste;
            $mesure->longueur_genou = $request->longueur_genou;
            $mesure->longueur_pantalon = $request->longueur_pantalon;
            $mesure->longueur_pantacourt = $request->longueur_pantacourt;
            $mesure->entre_jambe = $request->entre_jambe;
            $mesure->longueur_chemise_arabe = $request->longueur_chemise_arabe;
            $mesure->frappe = $request->frappe;
            $mesure->carrure = $request->carrure;
            if($request->sexe == env('SEXE_FEMININ'))
            {
                $mesure->ecart_pince_poitrine = $request->ecart_pince_poitrine;
                $mesure->longueur_jupe = $request->longueur_jupe;
                $mesure->longueur_robe = $request->longueur_robe;
                $mesure->longueur_poitrine = $request->longueur_poitrine;
                $mesure->longueur_haut = $request->longueur_haut;
            }
            $mesure->sexe = $request->sexe;
            $mesure->chapeau = $request->chapeau;
            $mesure->client_id = $request->client_id;
            $mesure->created_by =  Auth::user()->id;
            $mesure->updated_by = Auth::user()->id;

            $mesure->save();

            //Store mesure historique
            $mesure_historique = new mesure_historique();
            $mesure_historique->epaule = $request->epaule;
            $mesure_historique->longueur_epaule = $request->longueur_epaule;
            $mesure_historique->longueur_manche = $request->longueur_manche;
            $mesure_historique->bas = $request->bas;
            $mesure_historique->poitrine = $request->poitrine;
            $mesure_historique->dos = $request->dos;
            $mesure_historique->bassin = $request->bassin;
            $mesure_historique->longueur_taille = $request->longueur_taille;
            $mesure_historique->tour_genou = $request->tour_genou;
            $mesure_historique->ceinture = $request->ceinture;
            $mesure_historique->poignet = $request->poignet;
            $mesure_historique->tour_taille = $request->tour_taille;
            $mesure_historique->tour_manche = $request->tour_manche;
            $mesure_historique->cole = $request->cole;
            $mesure_historique->cuisse = $request->cuisse;
            $mesure_historique->longueur_chemise = $request->longueur_chemise;
            $mesure_historique->longueur_gilet = $request->longueur_gilet;
            $mesure_historique->longueur_veste = $request->longueur_veste;
            $mesure_historique->longueur_genou = $request->longueur_genou;
            $mesure_historique->longueur_pantalon = $request->longueur_pantalon;
            $mesure_historique->longueur_pantacourt = $request->longueur_pantacourt;
            $mesure_historique->entre_jambe = $request->entre_jambe;
            $mesure_historique->longueur_chemise_arabe = $request->longueur_chemise_arabe;
            $mesure_historique->frappe = $request->frappe;
            $mesure_historique->carrure = $request->carrure;
            if($request->sexe == env('SEXE_FEMININ'))
            {
                $mesure_historique->ecart_pince_poitrine = $request->ecart_pince_poitrine;
                $mesure_historique->longueur_jupe = $request->longueur_jupe;
                $mesure_historique->longueur_robe = $request->longueur_robe;
                $mesure_historique->longueur_poitrine = $request->longueur_poitrine;
                $mesure_historique->longueur_haut = $request->longueur_haut;
            }
            $mesure_historique->sexe = $request->sexe;
            $mesure_historique->chapeau = $request->chapeau;
            $mesure_historique->client_id = $request->client_id;
            $mesure_historique->created_by =  Auth::user()->id;
            $mesure_historique->updated_by = Auth::user()->id;
            $mesure_historique->save();


            alert()->success('Modification','Mesure modifiée avec succès');

            return redirect()->route('clients.detail',$request->client_id);

        }catch (\Exception $e){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $mesures = mesure::where('client_id', $id)->get();
            if(isset($mesures) && count($mesures) > 0){
                foreach ($mesures as $mesure) {
                    $mesure->delete();
                }
            }
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function view($client, $id)
    {
        $mesure = mesure::find($id);
        $mesure_historiques = mesure_historique::where('client_id',$client)->get();
        $client = client::find($client);

        return view ('pages.client.mesure.view', compact ('mesure', 'mesure_historiques', 'client'));

    }    public function print($id)
    {
        try
        {
            $mesure = mesure::where('client_id', $id)->first();
            $client = client::find($id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template = view ('pages.client.mesure.print', compact ('client', 'mesure', 'user', 'agence'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('mesure-'.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');

        }catch (\Exception $e){
            alert ()->error ('Message', 'Echec de l\'impression' . $e->getMessage ());
            return redirect()->route('clients.view',['id'=> $id ]); //Redirect to clients list page
        }
    }
}
