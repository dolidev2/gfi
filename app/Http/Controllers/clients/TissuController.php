<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\clients\tissus\TissuAddRequest;
use App\Http\Requests\clients\tissus\TissuEditRequest;
use App\Models\client;
use App\Models\Tissu;
use App\Models\TissuImage;

class TissuController extends Controller
{
    public function add ($id)
    {
        $client = client::find($id);
        return view ('pages.client.tissu.add', compact ('client'));
    }

    public function store (TissuAddRequest $request)
    {
        try {
            $tissu = new Tissu();
            $tissu->nom = $request->nom;
            $tissu->description = $request->description;
            if ($request->quantite) {
                $tissu->quantite = $request->quantite;
            }
            if ($request->prix) {
                $tissu->prix = $request->prix;
            }
            if ($request->commission) {
                $tissu->commission = $request->commission;
            }
            $tissu->client_id = $request->client_id;

            if($request->hasFile('imagesTissu')) {
                $tissuImages = $request->file('imagesTissu');
                if( isset($tissuImages) && count($tissuImages) > 0 ){
                    $tissu->save ();
                    foreach ($tissuImages as $key => $tissuImage) {
                        $tissuImageName = time().$key.'.'.$tissuImage->getClientOriginalExtension();
                        $tissuImage->move(public_path('images/tissus'),$tissuImageName);

                        $imageTissu = new TissuImage();
                        $imageTissu->nom = $tissuImageName;
                        $imageTissu->tissu_id = $tissu->id;
                        $imageTissu->save();
                    }
                }
            }else{
                $tissu->save ();
            }

            alert()->success('Ajout','Tissu ajouté avec succès');

            return redirect()->route('clients.detail', ['id'=> $request->client_id]); //Redirect to detail client page
        }catch (\Exception $e){
            alert()->warning('Ajout','Echec de l\'ajout car '.$e->getMessage());

            return  redirect()->route('client.tissu.add', ['id'=> $request->client_id]); //Redirect to detail client page
        }
    }

    public function view ($client, $id)
    {
        $tissu = tissu::find($id);
        $tissu->images = TissuImage::where('tissu_id', $id)->get();
        $client = client::find($client);

        return view ('pages.client.tissu.view', compact ('tissu', 'client'));
    }
    public function edit ($client, $id)
    {
        $tissu = tissu::find($id);
        $tissu->images = TissuImage::where('tissu_id', $id)->get();
        $client = client::find($client);

        return view ('pages.client.tissu.edit', compact ('tissu', 'client'));
    }


    public function update (TissuEditRequest $request)
    {
        try
        {
            $tissu = tissu::find($request->tissu_id);
            $tissu->nom = $request->nom;
            $tissu->description = $request->description;
            if ($request->quantite) {
                $tissu->quantite = $request->quantite;
            }
            if ($request->prix) {
                $tissu->prix = $request->prix;
            }
            if ($request->commission) {
                $tissu->commission = $request->commission;
            }
            if($request->hasFile('imagesTissu')) {
                $tissuImages = $request->file('imagesTissu');
                if( isset($tissuImages) && count($tissuImages) > 0 ){
                    //Delete old images
                    foreach ($tissuImages as $key => $tissuImage) {
                        $tissuImagesOld = TissuImage::where('tissu_id', $tissu->id)->get();
                        if( count($tissuImagesOld) > 0 ){
                            foreach ($tissuImagesOld as $tissuImageOld) {
                                unlink(public_path('images/tissus/'.$tissuImageOld->nom));
                                $tissuImageOld->delete();
                            }
                        }
                    }
                    //Add new image
                    foreach ($tissuImages as $key => $tissuImage) {
                        $tissuImageName = time().$key.'.'.$tissuImage->getClientOriginalExtension();
                        $tissuImage->move(public_path('images/tissus'),$tissuImageName);

                        $imageTissu = new TissuImage();
                        $imageTissu->nom = $tissuImageName;
                        $imageTissu->tissu_id = $tissu->id;
                        $imageTissu->save();
                    }
                }
            }

            $tissu->save ();

            alert()->success('Modification','Tissu modifié avec succès');
            return redirect()->route('clients.detail',$request->client_id);

        }catch (\Exception $e   ){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('client.tissu.edit',['client'=>$request->client_id, 'id'=> $tissu->id]);
        }
    }

    public function delete ($id)
    {
        try {
            $tissu = Tissu::find($id);
            $tissu->delete();

            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }


    public function viewClientTissu ($client)
    {
        try {
            $tissus = Tissu::where('client_id', $client)
                ->andWhere('statut', env('STATUS_FAILED'))
                ->orderBy('created_at', 'DESC')
                ->get();
            return response()->json($tissus);
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }
}
