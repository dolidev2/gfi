<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\UserAddRequest;
use App\Http\Requests\users\UserEditPasswordRequest;
use App\Http\Requests\users\UserEditRequest;
use App\Models\Agence;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function home ()
    {
        $users = User::all();

        return view ('pages.user.home', compact('users'));
    }

    public function add ()
    {
        $agences = Agence::all();
        return view ('pages.user.add', compact('agences'));
    }

    public function store(UserAddRequest $request){

        try {

            $user = new User();
            $user->nom_complet = $request->nom;
            $user->contact = $request->contact;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->password = Hash::make($request->password); //Hash password
            $user->agence_id = $request->agence;
            $user->status = env('STATUS_ACTIVE');

            $photoProfile = $request->file('photoProfile');
            if(!empty($photoProfile)){
                $photoProfileName = time().'.'.$photoProfile->getClientOriginalExtension();
                $photoProfile->move(public_path('images/users'),$photoProfileName);
                $user->image = $photoProfileName;
            }

            $photoCnibRecto = $request->file('photoCnibRecto');
            if(!empty($photoCnibRecto)){
                $photoCnibRectoName = time().'.'.$photoCnibRecto->getClientOriginalExtension();
                $photoCnibRecto->move(public_path('images/users'),$photoCnibRectoName);
                $user->cnib_recto = $photoCnibRectoName;
            }

            $photoCnibVerso = $request->file('photoCnibVerso');
            if(!empty($photoCnibVerso)){
                $photoCnibVersoName = time().'.'.$photoCnibVerso->getClientOriginalExtension();
                $photoCnibVerso->move(public_path('images/users'),$photoCnibVersoName);
                $user->cnib_verso = $photoCnibVersoName;
            }

            $user->save(); //Save user in database
            $notification = array([
                'message'=> "Utilisateur ajouté avec succès",
                'alert-type' => 'success',
            ]);

            return redirect()->route('users.list')->with($notification); //Redirect to users list page

        }catch (\Exception $e){

            $notification = array([
                'message'=>  $e->getMessage(),
                'alert-type' => 'error',
            ]);

            return redirect()->route('users.add')->with($notification);// Redirect to users add page
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user->agence = Agence::find($user->agence_id);
        $agences = Agence::all();
        return view('pages.user.edit', compact('user', 'agences'));
    }

    public function update (UserEditRequest $request)
    {
        try {

            $user = User::find(intval($request->user_id));
            $user->nom_complet = $request->nom;
            $user->contact = $request->contact;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->agence_id = $request->agence;

            $photoProfile = $request->file('photoProfile');
            if(!empty($photoProfile)){
                //Delete old image
                if( file_exists (public_path('images/users'.$user->image)) ){
                    $file = public_path('images/users'.$user->image);
                    try{
                        unlink($file);
                    }catch (\Exception $e){
                    }
                }
                $photoProfileName = time().'.'.$photoProfile->getClientOriginalExtension();
                $photoProfile->move(public_path('images/users'),$photoProfileName);
                $user->image = $photoProfileName;
            }

            $photoCnibRecto = $request->file('photoCnibRecto');
            if(!empty($photoCnibRecto)){
                //Delete old cnib_recto
                if( file_exists (public_path('images/users'.$user->cnib_recto)) ){
                    try {
                        unlink(public_path('images/users'.$user->cnib_recto));
                    }catch (\Exception $e){

                    }
                }
                $photoCnibRectoName = time().'.'.$photoCnibRecto->getClientOriginalExtension();
                $photoCnibRecto->move(public_path('images/users'),$photoCnibRectoName);
                $user->cnib_recto = $photoCnibRectoName;
            }

            $photoCnibVerso = $request->file('photoCnibVerso');
            if(!empty($photoCnibVerso)){
                //Delete old cnib_verso
                if( file_exists (public_path('images/users'.$user->cnib_verso)) ){
                    try {
                        unlink('images/users/'.$user->cnib_verso);
                    }catch (\Exception $e){

                    }
                }
                $photoCnibVersoName = time().'.'.$photoCnibVerso->getClientOriginalExtension();
                $photoCnibVerso->move(public_path('images/users'),$photoCnibVersoName);
                $user->cnib_verso = $photoCnibVersoName;
            }

            $user->save(); //Save user in database

            alert()->success('Modification','Utilisateur modifié avec succès');
            return redirect()->route('users.list') ;//Redirect to users list page

        }catch (\Exception $e){

            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('users.edit', ['id'=>$request->user_id]);// Redirect to users add page
        }
    }

    public function updatePassword(UserEditPasswordRequest $request){
        try {

            $user = User::find(intval($request->user_id));
            $user->password = Hash::make($request->password); //Hash password
            $user->save(); //Save user in database

            alert()->success('Modification','Mot de passe modifié avec succès');
            return redirect()->route('users.edit', ['id'=>$request->user_id]);// Redirect to users add page

        }catch (\Exception $e){
            alert()->warning('Modification','Echec de la modification car '.$e->getMessage());
            return redirect()->route('users.edit',['id'=>$request->user_id]);// Redirect to users add page
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find(intval($id));
            $user->delete();
            return response()->json(env('STATUS_SUCCESS'));
        }catch (\Exception $e){
            return response()->json(env('STATUS_FAILED'));
        }
    }






}
