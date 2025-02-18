<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\remarques\RemarqueAddRequest;
use App\Http\Requests\clients\remarques\RemarqueEditRequest;
use App\Models\Agence;
use App\Models\client;
use App\Models\Commande;
use App\Models\feedback_client;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemarqueController extends Controller
{
    public function store (RemarqueAddRequest $request){
        try {
            $remarque = new feedback_client();
            $remarque->client_id = $request->client_remarque_id;
            $remarque->commande_id = $request->commande_select_remarque;
            $remarque->commentaire = $request->remarque_description;

            $remarque->save();

            alert()->success('Ajout','Remarque ajoutée avec succès');
            return redirect()->route('clients.view',['id'=> $request->client_remarque_id]); //Redirect to detail client page

        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());
            return redirect()->route('clients.view',['id'=> $request->client_remarque_id]); //Redirect to detail client page
        }
    }

    public function view ($id)
    {
        try {

            $remarque = feedback_client::find($id);
            $remarque->commande = Commande::find($remarque->commande_id);

            return response()->json($remarque);
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function update (RemarqueEditRequest $request)
    {
        try {

            $remarque = feedback_client::find($request->remarque_id_up);
            $remarque->commande_id = $request->commande_select_remarque_up;
            $remarque->commentaire = $request->remarque_description_up;
            $remarque->updated_at = date('Y-m-d H:i:s');

            $remarque->save();

            alert()->success('Modification','Remarque modifiée avec succès');
            return redirect()->route('clients.view',$request->client_remarque_id_up);

        }catch (\Exception $e   ){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('client.view',['client'=>$request->client_remarque_id_up, 'id'=> $remarque->id]);
        }
    }

    public function delete ($id)
    {
        try {
            $remarque = feedback_client::find($id);
            $remarque->delete();

            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){

            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function print ($id)
    {
        try {
            $remarque = feedback_client::find($id);
            $client = client::find($remarque->client_id);
            $commande = Commande::find($remarque->commande_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template =    view ('pages.client.remarque.print', compact ('user' ,'agence', 'client', 'commande', 'remarque'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('commande-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');
        }
        catch (\Exception $e){
            alert()->warning('Erreur','Echec de l\'impression');

        }

    }
}
