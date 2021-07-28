<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\candidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $regions = DB::table("regions")->pluck("region", "id");
        $diplomes = DB::table("diplomes")->orderBy('id')->pluck("diplome", "id");

        return view('auth.RegisterCandidat', [
        'secteurs' => $secteurs,
        'regions' => $regions,
        'diplomes' => $diplomes
       ]);
    }
    public function store(Request $request)
    {
       
      $this->validate($request, [
        'civilite' =>'required',
        'nom' =>'required',
        'prenom' =>'required',
        'email' => 'required| email',
        'password' => 'required| confirmed',
        'dn' =>'required',
        'telephone' => 'required| min:10',
        'adresse' => 'required',
        'region' =>'required',
        'ville' => 'required ',
        'diplome' => 'required ',
        'secteur' => 'required',
        'metier' => 'required',
        'filecv' => 'required',
        
     ]);
     $users = User::where('email', '=', $request->input('email'))->first();
     if ($users != null) {
         return back()->with('status',"Email deja existe !");
     } else {
     
         DB::beginTransaction();
         try {
             $data= User::create([
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'role' => 'candidat']);
               if($request->has('filecv'))
               {
              $file= $request->filecv;
              $cv_name= time() . '_' . $file->getClientOriginalName();
              $file->move(public_path('Cvs'),$cv_name);
               }
             candidat::create([
               'user_id' => $data->id,
               'civilite' => $request->civilite,
               'nom' => $request->nom,
               'prenom' => $request->prenom,
               'dn' => $request->dn,
               'telephone' => $request->telephone,
               'telephoned' => $request->telephoned,
               'adresse' => $request->adresse,
               'region_id' => $request->region,
               'ville_id' => $request->ville,
               'diplome_id' => $request->diplome,
               'secteur_id' =>$request->secteur,
               'metier_id' => $request->metier,
               'filecv' => $cv_name,
            ]);
             DB::commit();
             Auth::attempt($request->only('email', 'password'));
             return redirect()->route('AccueillCandidat');
         } catch (\Exception $e) {
             DB::rollback();
             return back()->with('status', $e->getMessage());
         }
     }   
         }
     }
     