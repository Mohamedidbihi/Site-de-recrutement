<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        join('postulers', 'offres.id', '=', 'postulers.offre_id')->
        
        whereBetween('offres.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->
        //  where('Etat','Active')->
        groupBy('postulers.offre_id')->
        select('offres.*', 'villes.ville', DB::raw('COUNT(postulers.offre_id) as nbr') )->get();
      
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
        select('offres.*', 'villes.ville','typeoffre.typeoffre','diplomes.diplome','entreprises.societe')->paginate(10);
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
        select('offres.*', 'villes.ville','typeoffre.typeoffre','diplomes.diplome')->paginate(10);
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
         return back()->with('status',"Ajoute du l'offre pass avec succes !");

}
}
