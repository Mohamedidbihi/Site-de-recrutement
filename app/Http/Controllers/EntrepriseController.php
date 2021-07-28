<?php

namespace App\Http\Controllers;

use App\Models\offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
             return redirect()->route('mesannonces');
    }

    public function MesAnnonces()
    {
        
        $annonces = offre::where('user_id', Auth::id())->get();
        return view('entreprise.MesAnnonces', [
            'annonces' => $annonces,
           ]);
           
    }

    public function detail($id)
    {
        $offre = offre::with('villes')->findOrFail($id);
        return view('entreprise.MesAnnonces', compact('offre'));
          
              
    }
    public function destroy(offre $offre)
    {
        
       if ($offre->Etat =='en attente' && auth()->user()->id === $offre->user_id) {
           $offre->delete();
           return back();
       }
       else
       {
           abort(404);
       }
    }
    
}
