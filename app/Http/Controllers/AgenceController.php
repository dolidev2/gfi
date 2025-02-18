<?php

namespace App\Http\Controllers;

use App\Http\Requests\agences\AgenceAddRequest;
use App\Http\Requests\agences\AgenceEditRequest;
use App\Models\Agence;

class AgenceController extends Controller
{
    public function home ()
    {
        $agences = Agence::all();
        return view ('pages.agence.home', compact('agences'));
    }

    public function add ()
    {
        return view ('pages.agence.add');
    }

    public function store(AgenceAddRequest $request){
        try {
            $agence = new Agence();
            $agence->nom = $request->nom;
            $agence->adresse = $request->adresse;
            $agence->email = $request->email;
            $agence->contact = $request->contact;
            $agence->status = $request->status;
            $agence->boite_postale = $request->bpostale;
            $agence->ifu = $request->ifu;
            $agence->rccm = $request->rccm;
            $agence->division_fiscale = $request->dfiscale;
            $agence->regime_imposition = $request->rimposition;

            $logo = $request->file('logoProfil');
            if(!empty($logo)){

                $logoName = time().'.'.$logo->getClientOriginalExtension();
                $logo->move(public_path('images/agences'),$logoName);
                $agence->image = $logoName;
            }
            $agence->save(); //Save agence in database
            alert()->success('Ajout','Agence ajouté avec succès');

            return redirect()->route('agences.list'); //Redirect to agences list page

        }catch (\Exception $e){

            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());

            return redirect()->route('agences.add');// Redirect to agences add page
        }
    }

    public function edit($id)
    {
        $agence = Agence::find($id);
        return view ('pages.agence.edit', compact('agence'));
    }

    public function update (AgenceEditRequest $request)
    {
        try {

            $agence = Agence::find(intval($request->agence_id));
            $agence->nom = $request->nom;
            $agence->adresse = $request->adresse;
            $agence->email = $request->email;
            $agence->contact = $request->contact;
            $agence->status = $request->status;
            $agence->boite_postale = $request->bpostale;
            $agence->ifu = $request->ifu;
            $agence->rccm = $request->rccm;
            $agence->division_fiscale = $request->dfiscale;
            $agence->regime_imposition = $request->rimposition;

            $logo = $request->file('logoProfil');
            if(!empty($logo)){

                //Delete old image
                if( file_exists (public_path('images/agences'.$agence->image)) ){
                    $file = public_path('images/agences'.$agence->image);
                    try{
                        unlink($file);
                    }catch (\Exception $e){
                    }
                }
                $logoName = time().'.'.$logo->getClientOriginalExtension();
                $logo->move(public_path('images/agences'),$logoName);
                $agence->image = $logoName;
            }
            $agence->save();
            alert()->success('Modification','Agence modifié avec succès');
            return redirect()->route('agences.list') ;//Redirect to agences list page

        }catch (\Exception $e){

            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('agences.edit', ['id'=>$request->agence_id]);// Redirect to agences add page
        }
    }

    public function delete ($id)
    {
        try {
            $agence = Agence::find(intval($id));
            $agence->delete();
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }

    }
}
