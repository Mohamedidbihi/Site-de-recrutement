<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\offre;
use App\Models\candidat;
use App\Models\postuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\File\File;

class CandidatController extends Controller
{
    public function index(Request $request)
    {

     // $offres = offre::orderBy('created_at','desc')->with(['villes','regions'])->paginate(5);
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $regions = DB::table("regions")->pluck("region","id");
        $offres = DB::table('offres')->
        orderBy('offres.created_at','desc')->
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
        })->paginate(10);
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
            Alert::error('Vous avez Deja postuler a cet offre!!', 'Postuler a une autre offre ! ');
            return back()->with('status', "Vous avez Deja postuler a cet offre !");
         }
         else
         {
            postuler::create([
                'user_id' => Auth::id(),
                'offre_id' =>$offre->id]);
                Alert::success('Vous avez Bien postuler a cet offre!!', 'Votre demande est enregisté avec succes ! ');
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
        })->paginate(8);
        return view('candidat.Accueill', compact('offres'));

    }
    public function moncompte()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $regions = DB::table("regions")->pluck("region","id");
        $villes = DB::table("villes")->pluck("ville","id");
        $diplomes = DB::table("diplomes")->pluck("diplome","id");
        $candidat = DB::table('candidats')
        ->join('villes', 'villes.id', '=', 'candidats.ville_id')
        ->join('regions', 'regions.id', '=', 'villes.region_id')
        ->join('secteurs', 'secteurs.id', '=', 'candidats.secteur_id')
        ->join('diplomes', 'diplomes.id', '=', 'candidats.diplome_id')
        ->join('metiers', 'metiers.id', '=', 'candidats.metier_id')
        ->where('candidats.user_id','=',auth()->user()->id)
        ->select('*','candidats.created_at as datec')->get();
        
        return view('candidat.MonCompte',[
        'secteurs' => $secteurs,
        'regions' => $regions,
        'villes' => $villes,
        'candidats' => $candidat,
        'diplomes' => $diplomes
        ]);
    }
    public function update(Request $request)
    {
        try {
            $utilisateur =  User::find(auth()->user()->id);
            $utilisateur->email = $request->email;
            $candidats = candidat::where('user_id',auth()->user()->id)->first();;
            $candidats->nom = $request->nom;
            $candidats->prenom = $request->prenom;
            $candidats->dn = $request->dn;
            $candidats->telephone = $request->telephone;
            $candidats->telephoned = $request->telephoned;
            $candidats->adresse = $request->adresse;
            $candidats->region_id = $request->region;
           
            $cv_path = public_path('Cvs/' . $candidats->filecv);
          
            if($request->has('filecv'))
            {
                unlink($cv_path);
                $file= $request->filecv;
                $cv_name= time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('Cvs'),$cv_name);
                $candidats->filecv = $cv_name;
               
            }
           
            $candidats->ville_id = $request->ville;
            $candidats->diplome_id = $request->diplome;
            $candidats->secteur_id = $request->secteur;
            $candidats->metier_id = $request->metier;
            $candidats->save();
            $utilisateur->save();
            Alert::success('Vous avez Bien modifié!!', 'Vos information est modifié avec succes ! ');
            return back();
        }
        catch(Exception $e)
        {
            Alert::error('error de modification!!',$e->getMessage());
            return back();
        }    
    }
}
