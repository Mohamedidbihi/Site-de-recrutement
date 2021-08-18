<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\offre;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('entreprise.Accueill');
    }
    public function PublierAnnonce()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $villes = DB::table("villes")->pluck("ville","id");
        $diplomes = DB::table("diplomes")->orderBy('id')->pluck("diplome", "id");

        return view('entreprise.PublierAnnonce', [
        'secteurs' => $secteurs,
        'villes' => $villes,
        'diplomes' => $diplomes
       ]);
       
    }
    public function store(Request $request)
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
             'etat' => "en attente",
             'typeoffre_id' => $request->Typeoffre,
             'ville_id' => $request->ville]);
             Alert::success('Offre bien enregiste !!', 'Votre demande est envoyes ');
             return redirect()->route('mesannonces');
    }

    public function MesAnnonces()
    {
        
        $offre= offre::where('user_id' , Auth::id())->orderBy('offres.created_at', 'DESC')->paginate(10);
        $annonces = DB::table('offres')->
        join('villes', 'villes.id', '=', 'offres.ville_id')->
        join('secteurs', 'secteurs.id', '=', 'offres.secteur_id')->
        join('diplomes', 'diplomes.id', '=', 'offres.diplome_id')->
        join('typeoffre', 'typeoffre.id', '=', 'offres.Typeoffre_id')->
        where('user_id', Auth::id())->
        select('offres.*',"offres.Niveau d'experience as experience","secteurs.Secteur d'activite as secteur",'typeoffre.typeoffre','villes.ville','diplomes.diplome')->orderBy('offres.created_at', 'DESC')->paginate(10);
       
        return view('entreprise.MesAnnonces', [
            'annonces' => $annonces,
            'offres' =>$offre,
           ]);
           

    }

    // public function detail($id)
    // {
    //     $offre = offre::with('villes')->findOrFail($id);
    //     return view('entreprise.MesAnnonces', compact('offre'));
          
              
    // }
    public function destroy(offre $offre)
    {
        
       if ($offre->Etat =='en attente' && auth()->user()->id === $offre->user_id) {
           $offre->delete();
           Alert::error('Suppression avec succes !!', ' Proposition Supprimé ! ');
           return back();
       }
       else
       {
           abort(404);
       }
    }
    public function moncompte()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $regions = DB::table("regions")->pluck("region","id");
        $villes = DB::table("villes")->pluck("ville","id");
        $diplomes = DB::table("diplomes")->pluck("diplome","id");
        $entreprises = DB::table('entreprises')
        ->join('villes', 'villes.id', '=', 'entreprises.ville_id')
        ->join('regions', 'regions.id', '=', 'villes.region_id')
        ->join('secteurs', 'secteurs.id', '=', 'entreprises.secteur_id')
        ->where('entreprises.user_id','=',auth()->user()->id)
        ->select('*','entreprises.created_at as datec','entreprises.Raison sociale as Raison')->get();
        
        return view('entreprise.MoncompteRh',[
        'secteurs' => $secteurs,
        'regions' => $regions,
        'villes' => $villes,
        'entreprises' => $entreprises,

        ]);
    }
    public function update(Request $request)
    {
try {
    // auth()->user()->update([
    //          'email' => $request->email,
    //           ]);
    $utilisateur =  User::find(auth()->user()->id);
    $utilisateur->email = $request->email;
    $entreprise = Entreprise::where('user_id', auth()->user()->id)->first();
    $entreprise->societe = $request->societe;
    $entreprise->telephone = $request->telephone;
    $entreprise->fax = $request->fax;
    $entreprise->adresse = $request->adresse;
    $entreprise->ville_id = $request->ville;
    $entreprise->secteur_id = $request->secteur;
    $entreprise->save();
    $utilisateur->save();
    Alert::success('Vous avez Bien modifié!!', 'Vos information est modifié avec succes ! ');
    return back();
}
catch(Exception $e)
{
    Alert::error('error de modification!!','Email deja existe');
    return back();
}
        
        
    }    
}
