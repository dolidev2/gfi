<?php

namespace App\Http\Controllers\personnels;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\personnel;
use Illuminate\Http\Request;

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
            $matricule = 'GFI-PERS-1-';
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
}
