<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\commandes\CommandeAddRequest;
use App\Http\Requests\clients\commandes\CommandeEditRequest;
use App\Http\Requests\clients\commandes\composition\CompositionAddRequest;
use App\Models\Agence;
use App\Models\client;
use App\Models\Commande;
use App\Models\commande_modele_tissu;
use App\Models\modele;
use App\Models\paiement;
use App\Models\Tissu;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function store (CommandeAddRequest $request)
    {

        try
        {
            $commande = new Commande();
            $commande->numero_commande = $request->numero_commande;
            $date_rdv = explode('/',$request->date_rdv);
            $commande->date_rdv = date('Y-m-d', strtotime($date_rdv[2].'-'.$date_rdv[1].'-'.$date_rdv[0]));
            $date_obj_created = explode('/',$request->date_created);
            $commande->created_at = date('Y-m-d', strtotime($date_obj_created[2].'-'.$date_obj_created[1].'-'.$date_obj_created[0]));
            $commande->statut = env('STATUS_FAILED');
            $commande->client_id = $request->client_id_cmd;

            $commande->save();

            alert()->success('Ajout','Commande ajouté avec succès');
            return redirect()->route('clients.view',['id'=> $request->client_id_cmd]); //Redirect to clients list page

        }catch (\Exception $e){

            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());
            return redirect()->route('clients.view',['id'=> $request->client_id_cmd]); //Redirect to clients add page
        }
    }

    public function update (CommandeEditRequest $request)
    {
        try {
            $commande = Commande::find($request->commande_id);

            $date_rdv = explode('/',$request->date_rdv_up);
            $commande->date_rdv = date('Y-m-d', strtotime($date_rdv[2].'-'.$date_rdv[1].'-'.$date_rdv[0]));
            //Date created
            $date_obj_created = explode('/',$request->date_created_up);
            $commande->created_at = date('Y-m-d', strtotime($date_obj_created[2].'-'.$date_obj_created[1].'-'.$date_obj_created[0]));

            //Close commande
            if (isset($request->statut) && $request->statut == env('STATUS_SUCCESS')){
                $commandeComposition = commande_modele_tissu::where('commande_id', $request->commande_id)->get();
                foreach ($commandeComposition as $composition) {
                    $composition->statut = env('STATUS_SUCCESS');
                    $composition->save();
                }
            }
            $commande->statut = $request->statut;

            $commande->save();
            alert()->success('Modification','Commande modifié avec succès');

            return redirect()->route('clients.view',['id'=> $request->client_id_cmd]); //Redirect to clients list page
        }catch (\Exception $e){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());

            return redirect()->route('clients.view',['id'=> $request->client_id_cmd]); //Redirect to clients list page
        }
    }

    public function view ($client, $id)
    {
        $commande = Commande::where('id', $id)->first();
        $client = client::find($client);
        $commandeCompositions = commande_modele_tissu::where('commande_id', $id)->get();
        $modeles = modele::all();
        $tissus = Tissu::where('client_id', $client->id)
                ->where('statut', env('STATUS_FAILED'))
                ->get();

        return view ('pages.client.commande.view',
            compact ('client','commande', 'commandeCompositions', 'modeles','tissus'));
    }

    public function storeComposition (CompositionAddRequest $request)
    {
        try {
            //Modification des compositions de la commande existante
            $compositions = commande_modele_tissu::where('commande_id', $request->commande_id)->get();
            if(isset($request->composition_id) && count($request->composition_id) > 0){
                for ( $i = 0; $i < count($request->composition_id); $i++) {
                    foreach ($compositions as  $compo) {
                        if($compo->id == $request->composition_id[$i]){

                            $compo->modele_id = $request->modeles[$i];

                            //Modification du prix du modele s'il change
                            $modele_item= modele::find($request->modeles[$i]);
                            $compo->prix_modele = $modele_item->prix;
                            if(isset($request->tissu_id ) && count($request->tissu_id) > 0){
                                $compo->tissu_id = $request->tissus[$i];
                            }else{
                                $compo->tissu_id = env('STATUS_SUCCESS');
                            }
                            if(isset($request->remise ) && count($request->remise) > 0){
                                $compo->remise = $request->remise[$i];
                            }else{
                                $compo->remise = 0;
                            }
                            if(isset($request->quantite ) && count($request->quantite) > 0){
                                $compo->quantite = $request->quantite[$i];
                            }
                            else{
                                $compo->quantite =  env('STATUS_FAILED');
                            }
                            $compo->updated_at = date('Y-m-d H:i:s');
                            $compo->save();
                        }
                    }
                }
            }

            //verification s'il y a des modèles
            if(isset($request->modeles ) && count($request->modeles) > 0){
                $countComp = isset($request->composition_id) && count($request->composition_id) > 0 ? count($request->composition_id) : 0;
                for ($i= $countComp ; $i < count($request->modeles); $i++) {
                    $commandeComposition = new commande_modele_tissu();
                    $commandeComposition->commande_id = $request->commande_id;
                    $commandeComposition->modele_id = $request->modeles[$i];

                    $modele_item= modele::find($request->modeles[$i]);
                    $commandeComposition->prix_modele = $modele_item->prix;

                    if(isset($request->tissu_id ) && count($request->tissu_id) > 0){
                        $commandeComposition->tissu_id = $request->tissus[$i];
                    }else{
                        $commandeComposition->tissu_id = env('STATUS_SUCCESS');
                    }
                    if(isset($request->remise ) && count($request->remise) > 0){
                        $commandeComposition->remise = $request->remise[$i];
                    }else{
                        $commandeComposition->remise = 0;
                    }
                    if(isset($request->quantite ) && count($request->quantite) > 0){
                        $commandeComposition->quantite = $request->quantite[$i];
                    }
                    else{
                        $commandeComposition->quantite =  env('STATUS_FAILED');
                    }
                    $commandeComposition->statut = env('STATUS_FAILED');

                    $commandeComposition->save();
                }
            }else{
                alert ()->warning ('Ajout', 'Veuillez sélectionner un modèle');
                return redirect ()->route ('client.commande.view', ['client' => $request->client_id, 'id'=> $request->commande_id]); //Redirect to clients list page
            }

            alert ()->success ('Ajout', 'Modèle(s) ajouté(s) avec succès');
            return redirect ()->route ('client.commande.view', ['client' => $request->client_id, 'id'=> $request->commande_id]); //Redirect to clients list page

        }catch (\Exception $e) {
            alert ()->warning ('Ajout', 'Echec de l\'ajout car ' . $e->getMessage ());
            return redirect ()->route ('client.commande.view', ['client' => $request->client_id, 'id'=> $request->commande_id]); //Redirect to clients list page
        }
    }

    public function deleteComposition($id)
    {
        try {
            $commandeComposition = commande_modele_tissu::find($id);
            $commandeComposition->delete();

            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e) {
            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function print($client_id, $id)
    {
        try {
            $commande = Commande::find($id);
            $paiementController = new PaiementController();
            $commande->totalCommande = $paiementController->getTotalCommande($id);
            $commande->totalVersement = $paiementController->getTotalVersement($id);
            $commandeComposition = commande_modele_tissu::where('commande_id', $id)->get();
            $remise = false;
            if(isset($commandeComposition) && count($commandeComposition) > 0 ){
                foreach ($commandeComposition as $composition) {
                    $composition->modele = modele::find($composition->modele_id);
                    $composition->tissu = Tissu::find($composition->tissu_id);
                    if($composition->remise == null){
                        $composition->remise = 0;
                    }
                    else{
                        $remise =true;
                    }

                    $composition->prix = ($composition->modele->prix * $composition->quantite) - $composition->remise;
                }
            }

            $client = client::find($client_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template = view ('pages.client.commande.print', compact ('client', 'commande', 'agence', 'user', 'commandeComposition','remise'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('commande-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');

        }catch (\Exception $e){
            alert ()->error ('Message', 'Echec de l\'impression' . $e->getMessage ());
            return redirect()->back(); //Redirect to clients list page
        }
    }

    public function printAll($client_id)
    {
        try {
            $commandes = Commande::where('client_id', $client_id)
                ->where('statut', env('STATUS_FAILED'))
                ->get();
            $paiementController = new PaiementController();
            foreach ($commandes as $commande) {
                $commande->totalCommande = $paiementController->getTotalCommande($commande->id);
                $commande->totalVersement = $paiementController->getTotalVersement($commande->id);
                $commande->composition = commande_modele_tissu::where('commande_id', $commande->id)->get();

                if(isset($commande->composition) && count($commande->composition) > 0 ){

                    $commande->composition->each(function($composition){
                        $composition->modele = modele::find($composition->modele_id);
                        $composition->tissu = Tissu::find($composition->tissu_id);
                        if($composition->remise == null){
                            $composition->remise = 0;
                        }
                        $composition->prix = ($composition->modele->prix * $composition->quantite) - $composition->remise;
                    });
                }
            }

            $client = client::find($client_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template = view ('pages.client.commande.printAll', compact ('client', 'commandes', 'agence', 'user'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('commande-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');
        }catch (\Exception $e){
            alert ()->error ('Message', 'Echec de l\'impression' . $e->getMessage ());
            return redirect()->route('clients.view',['id'=> $client_id ]); //Redirect to clients list page
        }
    }

    public function viewOne($id)
    {
        try {
            $commande = Commande::find ($id);
            $commande->date_created = date('d/m/Y', strtotime($commande->created_at));
            $commande->date_rdv = date('d/m/Y', strtotime($commande->date_rdv));
            return response()->json($commande);

        }catch (\Exception $e){
          return response()->json(env('STATUS_FAILED'));
        }
    }

    public function delete($id)
    {
        try {
            $paiements = paiement::where('commande_id', $id)->get();
            foreach ($paiements as $paiement) {
                $caisse = caisse::find($paiement->caisse_id);
                $caisse->delete();
                $paiement->delete();
            }
            $composition = commande_modele_tissu::where('commande_id', $id)->get();
            foreach ($composition as $composition) {
                $composition->delete();
            }
            $commande = Commande::find($id);
            $commande->delete();
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }


}
