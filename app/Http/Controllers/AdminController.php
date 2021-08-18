<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $active = offre::where('Etat','Active')->count();
        $refused = offre::where('Etat','Refuser')->count();
        $en_attente = offre::where('Etat','en attente')->count();
        $offres = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        leftJoin('postulers', 'offres.id', '=', 'postulers.offre_id')->
        whereBetween('offres.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->
        //  where('Etat','Active')->
        groupBy('offres.id')->
        select('offres.*', 'villes.ville', DB::raw('COUNT(postulers.offre_id) as nbr') )->paginate(5);
      
        return view('Dashboard.dashboard',[
            'active' => $active,
            'refused' => $refused,
            'en_attente' => $en_attente,
            'offresweek' =>$offres
            

        ]);
    
    }
    public function offres()
    {  
        $offres = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        join('secteurs', 'secteurs.id', '=', 'offres.secteur_id')->
        join('typeoffre', 'typeoffre.id', '=', 'offres.Typeoffre_id')->
        join('diplomes', 'diplomes.id', '=', 'offres.diplome_id')->
        join('entreprises', 'entreprises.user_id', '=', 'offres.user_id')->
        select('offres.*', 'villes.ville','typeoffre.typeoffre','diplomes.diplome','entreprises.societe')->orderBy('offres.created_at', 'DESC')->paginate(10);
        return view('Dashboard.Offres',[
            'AllOffres' => $offres
        ]);   
    }
    public function  Activer($id)
    {
       
        $offre = offre::findOrFail($id);
        $offre->Etat = "Active";
        $offre->save();
        return back();
    }
    public function  Refuser($id)
    {
        
        $offre = offre::findOrFail($id);
        $offre->Etat = "Refuser";
        $offre->save();
        return back();
    }
    public function  En_attente($id)
    {
       
        $offre = offre::findOrFail($id);
        $offre->Etat = "en attente";
        $offre->save();
        return back();
    }
    public function ajitkhdem()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $villes = DB::table("villes")->pluck("ville","id");
        $diplomes = DB::table("diplomes")->orderBy('id')->pluck("diplome", "id");
        $offres = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        join('secteurs', 'secteurs.id', '=', 'offres.secteur_id')->
        join('typeoffre', 'typeoffre.id', '=', 'offres.Typeoffre_id')->
        join('diplomes', 'diplomes.id', '=', 'offres.diplome_id')->
        join('users', 'users.id', '=', 'offres.user_id')->
        where('users.role','=','admin')->
        select('offres.*', 'villes.ville','typeoffre.typeoffre','diplomes.diplome')->orderBy('offres.created_at', 'DESC')->paginate(7);
        
        return view('Dashboard.AjiTkhdem',[
            'AjitkhdemOffres' => $offres,
            'secteurs' => $secteurs,
            'villes' => $villes,
            'diplomes' => $diplomes
        ]);
    }
public function CreateOffre(Request $request)
{
   
    $this->validate($request, [
        'titre' => 'required',
        'description' => 'required',
        'secteur' => 'required',
        'diplome' => 'required',
        'experience' =>'required',
        'ville' => 'required ',
        'Typeoffre' => 'required ',
               ]);
        offre::create([
        'user_id' => Auth::id(),
         'titre' => $request->titre,
        'description' => $request->description,
        'secteur_id' => $request->secteur,
        'diplome_id' => $request->diplome,
         "Niveau d'experience" => $request->experience,
         'etat' => "Active",
         'typeoffre_id' => $request->Typeoffre,
         'ville_id' => $request->ville]);
         Alert::success('Offre bien ajouté', 'Offre ajouté est deja active! ');
         return back()->with('status',"Ajoute du l'offre pass avec succes !");

}
public function candidat(Request $request)
{
    $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
    $regions = DB::table("regions")->pluck("region","id");
    $metiers = DB::table("metiers")->pluck("metier","id");
    $diplomes = DB::table("diplomes")->orderBy('id')->pluck("diplome", "id");
    $candidats = DB::table('candidats')->
    join('villes', 'villes.id', '=', 'candidats.ville_id')->
    join('secteurs', 'secteurs.id', '=', 'candidats.secteur_id')->
    join('diplomes', 'diplomes.id', '=', 'candidats.diplome_id')->
    join('metiers', 'metiers.id', '=', 'candidats.metier_id')->
    join('regions', 'regions.id', '=', 'villes.region_id')->
 
    when($request->metier, function ($query, $metier) {
        return $query->where('metier_id',$metier);
    })-> when($request->diplome, function ($query, $diplome) {
        return $query->where('diplome_id',$diplome);
    })->when($request->secteur, function ($query, $secteur) {
        return $query->where('candidats.secteur_id',$secteur);
    })->when($request->region, function ($query, $region) {
        return $query->where('regions.id',$region);
    }, function ($query) {
        return $query;
    })->
    select('candidats.*', 'villes.ville','metiers.metier','diplomes.diplome')->orderBy('candidats.created_at', 'DESC')->paginate(10);
    session()->flashInput($request->input());
    return view('Dashboard.DashCandidat',[
        'candidats'=>$candidats,
        'metiers' => $metiers,
        'secteurs' => $secteurs,
        'regions' => $regions,
        'diplomes' => $diplomes,

    ]);

}
public function entreprise(Request $request)
{
    $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
    $regions = DB::table("regions")->pluck("region","id");
    $entreprises = DB::table('entreprises')->
    join('secteurs','secteurs.id','=','entreprises.secteur_id')->
    join('villes','villes.id','=','entreprises.ville_id')->
    join('regions','regions.id','=','villes.region_id')-> 
    when($request->MotCles, function ($query, $MotCles) {
    return $query->where('societe', 'like', "%{$MotCles}%");
    })->when($request->secteur, function ($query, $secteur) {
        return $query->where('entreprises.secteur_id',$secteur);
    })->when($request->region, function ($query, $region) {
        return $query->where('regions.id',$region);
    }, function ($query) {
        return $query;
    })->
    select('entreprises.*',"entreprises.Raison sociale as raison", 'villes.ville',"secteurs.Secteur d'activite as secteur")->orderBy('entreprises.created_at', 'DESC')->paginate(7);
    session()->flashInput($request->input());
    return view('Dashboard.Entreprise',[
        'entreprises'=>$entreprises,
        'secteurs'=>$secteurs,
        'regions'=>$regions,
    ]);
    
}

public function infosOffres()
{
    $offres = DB::table('offres')->
    join('villes', 'villes.id', '=', 'offres.ville_id')->
    join('secteurs', 'secteurs.id', '=', 'offres.secteur_id')->
    join('typeoffre', 'typeoffre.id', '=', 'offres.Typeoffre_id')->
    join('diplomes', 'diplomes.id', '=', 'offres.diplome_id')->
    join('users', 'users.id', '=', 'offres.user_id')->
    where('offres.Etat','=','active')->
    leftJoin('postulers', 'offres.id', '=', 'postulers.offre_id')->
    groupBy('offres.id')->
    select('offres.*',"secteurs.Secteur d'activite as secteur",'villes.ville','typeoffre.typeoffre','diplomes.diplome',DB::raw('COUNT(postulers.offre_id) as nbr'))->orderBy('offres.created_at', 'DESC')->paginate(7);
    return view('Dashboard.InfosOffres',[
        'offres' => $offres
    ]);
}
public function QuiPostule($id)
{
    
    $offres = DB::table('candidats')->
    join('villes', 'villes.id', '=', 'candidats.ville_id')->
    join('secteurs', 'secteurs.id', '=', 'candidats.secteur_id')->
    join('diplomes', 'diplomes.id', '=', 'candidats.diplome_id')->
    join('metiers', 'metiers.id', '=', 'candidats.metier_id')->
    rightJoin('postulers','postulers.user_id', '=','candidats.user_id')->
    join('offres','offres.id', '=','postulers.offre_id')->
    where('postulers.offre_id',$id)->
    select('candidats.*','offres.*',"secteurs.Secteur d'activite as secteur", 'villes.ville','metiers.metier','diplomes.diplome')->orderBy('candidats.created_at', 'DESC')->paginate(10);
    return view('Dashboard.QuiPostule',[
        'offres'=>$offres,
    ]);
}
}
