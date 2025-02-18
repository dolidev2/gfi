<?php

namespace App\Http\Controllers;

use App\Http\Requests\outils\modele\ModeleAddRequest;
use App\Http\Requests\outils\modele\ModeleEditRequest;
use App\Models\modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    public function home ()
    {
        $modeles = modele::all();
        return view ('pages.modele.home', compact ('modeles'));
    }

    public function view ()
    {
        $modeles = modele::where('statut', env('MODELE_SIMPLE'))->get();
        return response()->json($modeles);
    }

    public function add ()
    {
        return view ('pages.modele.add');

    }

    public function store (ModeleAddRequest $request)
    {
        try {
            $modele = new modele();
            $modele->nom = $request->nom;
            if($request->description){
                $modele->description = $request->description;
            }
            $modele->prix = $request->prix;
            $modele->cout_montage = $request->cout_montage;
            $modele->cout_decoupage = $request->cout_decoupage;
            $modele->statut = env('MODELE_SIMPLE');

            //Store modeles
            if(isset($request->modeles) && count($request->modeles) > 0){
                $modele->statut = env('MODELE_COMPLEXE');
                $dataModeles = [];
                foreach ($request->modeles as $objModele) {
                    array_push($dataModeles, $objModele);
                }
                $modele->modeles = $dataModeles;
            }
            //Store images
            if($request->hasFile('imagesModele')) {

                $modeleImages = $request->file('imagesModele');
                $dataImages = [];
                if( isset($modeleImages) && count($modeleImages) > 0 ){
                    foreach ($modeleImages as $key => $modeleImage) {
                        $modeleImageName = time().$key.'.'.$modeleImage->getClientOriginalExtension();
                        $modeleImage->move(public_path('images/modeles'),$modeleImageName);
                        array_push($dataImages, $modeleImageName);
                    }
                    $modele->images = $dataImages;
                }
            }
            $modele->save ();

            alert()->success('Ajout','Modèle ajouté avec succès');
            return redirect()->route('modeles.list');
        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());
            return  redirect()->route('modeles.add');
        }
    }

    public function detail ($id)
    {
        try {
            $modele = modele::find($id);

            //Check if modele is complex
            if( $modele->statut == env('MODELE_COMPLEXE')){
                $dataModeles = [];
                foreach ($modele->modeles as $obj){
                    $objModele = modele::find($obj);
                    array_push($dataModeles, $objModele);
                }
                $modele->modeles = $dataModeles;
            }

            return view ('pages.modele.detail', compact ('modele'));
        }catch (\Exception $e){
            alert()->warning('Modèle','Aucun modèle trouvé');
            return  redirect()->route('modeles.detail',compact('id'));
        }
    }

    public function edit ($id)
    {
        try {
            $modele = modele::find($id);

            //Check if modele is complex
            if( $modele->statut == env('MODELE_COMPLEXE')){
                $dataModeles = [];
                foreach ($modele->modeles as $obj){
                    $objModele = modele::find($obj);
                    array_push($dataModeles, $objModele);
                }
                $modele->modeles = $dataModeles;
            }

            return view ('pages.modele.edit', compact ('modele'));
        }catch (\Exception $e){
            alert()->warning('Modèle','Aucun modèle trouvé');
            return  redirect()->route('modeles.detail',compact('id'));
        }

    }

    public function update (ModeleEditRequest $request)
    {
        try {
            $modele = modele::find($request->modele_id);

            $modele->nom = $request->nom;
            if($request->description){
                $modele->description = $request->description;
            }
            $modele->prix = $request->prix;
            $modele->cout_montage = $request->cout_montage;
            $modele->cout_decoupage = $request->cout_decoupage;

            //Update modeles

            if( isset($request->modeles) && count($request->modeles) > 0){
                $dataModeles = [];
                if ($modele->modeles != null) {
                    $dataModeles = $modele->modeles;
                }
                $modele->statut = env('MODELE_COMPLEXE');
                foreach ($request->modeles as $objModele) {
                    array_push($dataModeles , $objModele);
                }
                $modele->modeles = $dataModeles;
            }

            if($request->hasFile('imagesModele')) {

                $modeleImages = $request->file('imagesModele');
                $dataImages = [];
                if($modele->images != null) {
                    foreach ($modele->images as $image) {
                        $pathfile = public_path('images/modeles/'.$image);
                        if(file_exists (public_path($pathfile))){
                            unlink(public_path($pathfile));
                        }
                    }
                }
                if( isset($modeleImages) && count($modeleImages) > 0 ){
                    foreach ($modeleImages as $key => $modeleImage) {
                        $modeleImageName = time().$key.'.'.$modeleImage->getClientOriginalExtension();
                        $modeleImage->move(public_path('images/modeles'),$modeleImageName);
                        array_push($dataImages, $modeleImageName);
                    }
                    $modele->images = $dataImages;
                }
            }
            $modele->save ();

            alert()->success('Modification','Modèle modifié avec succès');
            return redirect()->route('modeles.list');
        }catch (\Exception $e){

            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return  redirect()->route('modeles.edit',['id'=> $request->modele_id]);
        }
    }

    public function delete ($id)
    {

    }

    public function deleteComposition ($modele_id, $id)
    {
        try {
            $modele = modele::find($modele_id);

            //Delete modele
            if($modele->modeles != null){
                $dataModele = $modele->modeles;
                $modeleToDelete = array_search($id, $dataModele);
                if (false !== $modeleToDelete) {
                    unset($dataModele[$modeleToDelete]);
                }
                $modele->modeles = $dataModele;
            }
            $modele->save();
            return response()->json(env('STATUS_SUCCESS'));
        } catch (\Exception $e) {
            return response()->json(env('STATUS_FAILED'));
        }

    }

    public function viewOne ($id)
    {
        try {
            $modele = modele::find($id);
            return response()->json($modele);
        }catch (\Exception $e){
            return  response()->json(env('STATUS_FAILED'));
        }
    }

}
