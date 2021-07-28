<?php

namespace App\Http\Controllers\Auth;
use Exception;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterEntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        $secteurs = DB::table("secteurs")->pluck("Secteur d'activite", "id");
        $villes = DB::table("villes")->pluck("ville","id");
        return view('auth.registerEntreprise',compact('villes'),compact('secteurs'));
    }
   

    public function store(Request $request)
    {
 
        $this->validate($request, [
'email' => 'required| email',
'password' => 'required| confirmed',
'societe' => 'required',
'raison' => 'required',
'secteur' =>'required',
'telephone' => 'required ',
'fax' => 'required ',
'ville' => 'required',
'adresse' => 'required'
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
          'role' => 'entreprise']);
        Entreprise::create([
          'user_id' => $data->id,
          'societe' => $request->societe,
          'Raison sociale' => $request->raison,
          'secteur_id' => $request->secteur,
          'telephone' => $request->telephone,
          'fax' => $request->fax,
          'ville_id' => $request->ville,
          'adresse' => $request->adresse]);
        DB::commit();
        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('AccueillEntreprise');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('status', "Erreur d'insertion");
    }
}   
    }
}
