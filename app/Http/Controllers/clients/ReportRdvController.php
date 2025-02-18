<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\commandes\report\AddReportRequest;
use App\Http\Requests\clients\commandes\report\EditReportRequest;
use App\Models\Agence;
use App\Models\client;
use App\Models\Commande;
use App\Models\report_rdv;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportRdvController extends Controller
{
    public function view ($id){

        $commande = Commande::find($id);
        $client = client::find($commande->client_id);
        $reports = report_rdv::where ('commande_id', $id)->get();

        return view ('pages.client.commande.reportRDV.view', compact ('client', 'commande', 'reports'));
    }
    public function store (AddReportRequest $request)
    {
        try {
            $report = new report_rdv();
            $date_rdv = explode('/',$request->date_report);
            $report->date_rdv = date('Y-m-d', strtotime($date_rdv[2].'-'.$date_rdv[1].'-'.$date_rdv[0]));
            $report->motif = $request->report_motif;
            $report->commande_id = $request->commande_id_report;
            $report->save();

            alert()->success('Ajout','Report RDV ajouté avec succès');
            return redirect()->route('client.commande.report.view',['commande'=> $report->commande_id]); //Redirect to report RDV list page

        }catch (\Exception $e){

            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());

            return redirect()->back(); //Redirect to report RDV list page
        }
    }

    public function update (EditReportRequest $request)
    {
        try {
            $commande = Commande::find($request->commande_id_report);
            $commande->date_rdv = date('Y-m-d', strtotime($request->date_report));
            $commande->motif = $request->report_motif;
            $commande->save();

            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function delete ($id)
    {
        try {

            $report = report_rdv::find($id);
            $report->delete();

            return response()->json(env('STATUS_SUCCESS'));

        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }

    public function print($client_id, $id)
    {
        try {

            $report = report_rdv::find($id);
            $commande = Commande::find($report->commande_id);
            $client = client::find($client_id);
            $agence = Agence::find($client->agence_id);
            $id_user = Auth::user ()->id;
            $user = User::find($id_user);

            $template = view ('pages.client.commande.reportRDV.print', compact ('client', 'commande', 'agence', 'user', 'report'));
            $pdf = Pdf::loadHTML($template->render());

            return $pdf->stream('commande-'.$commande->numero_commande.'-'.$client->nom_complet.'-'.$client->matricule.'.pdf');
        }catch (\Exception $e){

            alert ()->error ('Message', 'Echec de l\'impression' . $e->getMessage ());
            return redirect()->back(); //Redirect to report list page
        }
    }

    public function viewOne($id)
    {
        try {

            $report = report_rdv::find($id);
            return response()->json($report);

        }catch (\Exception $e){
            return  response()->json(env('STATUS_FAILED'));
        }
    }
}
