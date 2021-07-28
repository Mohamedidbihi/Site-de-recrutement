<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    { 
        return view('auth.login');
    }
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
               ]);
          
               if(Auth::attempt($request->only('email','password'),$request->remember))
               {
                if(Auth::user()->role == 'candidat')
                {
                 return redirect()->route('AccueillCandidat');
                }
                elseif(Auth::user()->role == 'entreprise')
                {
                 return redirect()->route('AccueillEntreprise');
                }
                else{
                 return redirect()->route('Dashboard'); 
                }
               }
               return back()->with('status','Invalid login details');
    }
}
