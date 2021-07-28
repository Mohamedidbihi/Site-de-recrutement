<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropDownSecteurMetier extends Controller
{
    public function getMetiers($id)
 {
     echo json_encode(DB::table('metiers')->where('secteur_id', $id)->get());   
 }
}
