<?php

namespace App\Http\Controllers\personnels;

use App\Http\Controllers\Controller;
use App\Http\Requests\personnels\PersonnelAddRequest;
use App\Http\Requests\personnels\PersonnelEditRequest;
use App\Models\Agence;
use App\Models\personnel;

class personnelController extends Controller
{
    public function getMatricule()
    {
        //Matricule du collaborateur
        $personnel = personnel::all()->last();
        if ( isset($personnel) && is_array($personnel->matricule)  ) {
            $num = explode('-',$personnel->matricule);
            $matricule = 'GFI-PERS-'.($num[2]+1);
        }else{
            $matricule = 'GFI-PERS-1';
        }

        return $matricule;
    }


    public function home ()
    {
        $personnels = personnel::all();
        $personnels->each(function($personnel){
            $personnel->agence = Agence::find($personnel->agence_id);
        });
        return view ('pages.personnel.home', compact ('personnels'));
    }

    public function add()
    {
        $agences = Agence::all ();
        $matricule = $this->getMatricule();
        return view ('pages.personnel.add', compact ('agences', 'matricule'));
    }

    public function store(PersonnelAddRequest $request)
    {
        try {

            $personnel = new personnel ();
            $personnel->nom_complet = $request->nom;
            $personnel->matricule = $request->matricule;
            $personnel->contact = $request->contact;
            $personnel->adresse = $request->adresse;
            $personnel->created_at = $request->date_arrive;
            $personnel->agence_id = $request->agence;

            $photoProfil = $request->file('photoProfile');
            if(isset($photoProfil) && !empty($photoProfil)){

                $photoProfilName = time().'.'.$photoProfil->getClientOriginalExtension();
                $photoProfil->move(public_path('images/personnels'),$photoProfilName);
                $personnel->image = $photoProfilName;
            }

            $imageCnibRecto = $request->file('imageCnibRecto');
            if(isset($imageCnibRecto) && !empty($imageCnibRecto)){

                $imageCnibRectoName = time().'.'.$imageCnibRecto->getClientOriginalExtension();
                $imageCnibRecto->move(public_path('images/personnels'),$imageCnibRectoName);
                $personnel->cnib_recto = $imageCnibRectoName;
            }

            $imageCnibVerso = $request->file('imageCnibVerso');
            if(isset($imageCnibVerso) && !empty($imageCnibVerso)){

                $imageCnibVersoName = time().'.'.$imageCnibVerso->getClientOriginalExtension();
                $imageCnibVerso->move(public_path('images/personnels'),$imageCnibVersoName);
                $personnel->cnib_verso = $imageCnibVersoName;
            }

            $personnel->save ();
            alert()->success('Ajout','Personnnel ajouté avec succès');

            return redirect()->route('personnels.list'); //Redirect to personnels list page

        }catch (\Exception $e) {
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $personnel = personnel::find($id);
        $personnel->agence = Agence::find($personnel->agence_id);
        $agences = Agence::all();

        return view ('pages.personnel.edit', compact ('personnel', 'agences'));
    }

    public function update (PersonnelEditRequest $request)
    {
        try {
            $personnel = personnel::find($request->personnel_id);
            $personnel->nom_complet = $request->nom;
            $personnel->contact = $request->contact;
            $personnel->adresse = $request->adresse;
            $personnel->agence_id = $request->agence;

            $photoProfil = $request->file('photoProfile');
            if(isset($photoProfil) && !empty($photoProfil)){

                $photoProfilName = time().'.'.$photoProfil->getClientOriginalExtension();
                $photoProfil->move(public_path('images/personnels'),$photoProfilName);
                $personnel->image = $photoProfilName;
            }

            $imageCnibRecto = $request->file('imageCnibRecto');
            if(isset($imageCnibRecto) && !empty($imageCnibRecto)){

                $imageCnibRectoName = time().'.'.$imageCnibRecto->getClientOriginalExtension();
                $imageCnibRecto->move(public_path('images/personnels'),$imageCnibRectoName);
                $personnel->cnib_recto = $imageCnibRectoName;
            }

            $imageCnibVerso = $request->file('imageCnibVerso');
            if(isset($imageCnibVerso) && !empty($imageCnibVerso)){

                $imageCnibVersoName = time().'.'.$imageCnibVerso->getClientOriginalExtension();
                $imageCnibVerso->move(public_path('images/personnels'),$imageCnibVersoName);
                $personnel->cnib_verso = $imageCnibVersoName;
            }

            $personnel->save ();
            alert()->success('Modification','Personnel modifié avec succès');

            return redirect()->route('personnels.list'); //Redirect to personnels list page

        }catch (\Exception $e) {
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function delete ($id)
    {
        try {
            $personnel = personnel::find(intval($id));
            $personnel->delete();
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }

}
