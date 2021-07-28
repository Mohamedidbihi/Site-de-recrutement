<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropDownRegionVilleController extends Controller
{
  
 public function getVilles($id)
 {
     echo json_encode(DB::table('villes')->where('Region_id', $id)->get());   
 }

}
