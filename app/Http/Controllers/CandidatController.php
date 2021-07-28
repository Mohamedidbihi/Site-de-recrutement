<?php

namespace App\Http\Controllers;

use App\Models\offre;
use App\Models\postuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CandidatController extends Controller
{
    public function index(Request $request)
    {

        // $offres = offre::orderBy('created_at','desc')->with(['villes','regions'])->paginate(5);
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $regions = DB::table("regions")->pluck("region","id");
        $offres = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        join('regions', 'regions.id', '=', 'villes.region_id')->
        where('Etat','Active')->
        select('offres.*', 'villes.ville')->
        when($request->MotCles, function ($query, $MotCles) {
            return $query->where('Titre', 'like', "%{$MotCles}%");
        })->when($request->secteur, function ($query, $secteur) {
            return $query->where('secteur_id',$secteur);
        })->when($request->region, function ($query, $region) {
            return $query->where('region_id',$region);
        }, function ($query) {
            return $query;
        })->get();
        session()->flashInput($request->input());
        return view('candidat.Accueill', [
            'secteurs' => $secteurs,
            'regions' => $regions,
            'offres' => $offres,
       
           ]);
  
    }
    public function show(Offre $offre)
    {
   
        if($offre->Etat === 'Active')
         {
         $data = DB::table('offres')
        ->join('villes', 'villes.id', '=', 'offres.ville_id')
        ->join('typeoffre', 'typeoffre.id', '=', 'offres.Typeoffre_id')
        ->join('secteurs', 'secteurs.id', '=', 'offres.secteur_id')
        ->join('diplomes', 'diplomes.id', '=', 'offres.diplome_id')
        ->where('offres.id',$offre->id)
        ->select('offres.*',"offres.Niveau d'experience as niveau", 'villes.ville',"secteurs.Secteur d'activite",'typeoffre.typeoffre','diplomes.diplome')
        ->get();         
           return view('candidat.PostulerOffre',[
               'offre'=>$data,
           ]);
        }
        else
        {
            abort(404);
        }
    
    }
    public function postuler(offre $offre)
    {
    
        $check = postuler::where('offre_id', '=',$offre->id)->where('user_id', '=',auth()->user()->id)->first();
        
        if ($check != null)
         {
            return back()->with('status', "Vous avez Deja postuler a cet offre !");
         }
         else
         {
            postuler::create([
                'user_id' => Auth::id(),
                'offre_id' =>$offre->id]);
                 return back()->with('status1', "Vous avez Bien Postuler !");
                
         }
    }
    public function recherche(Request $request)
    {
       
      
        $offres = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        join('regions', 'regions.id', '=', 'villes.region_id')->
        when($request->MotCles, function ($query, $MotCles) {
            return $query->where('Titre', 'like', "%{$MotCles}%");
        })->when($request->secteur, function ($query, $secteur) {
            return $query->where('secteur_id',$secteur);
        })->when($request->region, function ($query, $region) {
            return $query->where('region_id',$region);
        }, function ($query) {
            return $query;
        })->paginate(15);
        dd($offres);
        return view('candidat.Accueill', compact('offres'));

    }
}
