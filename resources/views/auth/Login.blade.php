@extends('layouts.app')

@section('content')
@include('layouts.header')
  <!-- blocA -->
  <div class="blocA">
    <div class="blank"></div>
</div>
<!-- Form-->
<div class="banner-image2 w-100 vh-200 d-flex justify-content-center align-items-center ">
    <section class="intro pt-4">
        <div class="mask d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 mx-auto ">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="card-body p-5" id='form'>
                                <h1 class="mb-3 text-center Titre_formulaire">INSCRIVEZ VOUS SUR AJI TKHDEM </h1>
                                @if(session('status'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                
                                <form action="{{ route('login') }}" method="post">
                                     @csrf
                                    <div class="row">
                                      <div class="col-12 col-md-12 mb-4">
                                          <div class="form-outline">
                                            <label class="form-label" >{{ __('Email') }} :*</label>
                                              <input type="text" class="form-control @error('email')border border-danger" @enderror"  name="email" id="email" placeholder="Ton adresse email"   />
                                              @error('email')
                                              <div class="text-danger">
                                              {{ $message }}
                                              </div>
                                              @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" >{{ __('Password') }} : *</label>
                                                <input type="password" class="form-control  @error('password') border border-danger" @enderror " name="password" id="password" placeholder="Mot de passe"  />
                                                @error('password')
                                                <div class="text-danger">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                            </div>
                                          </div>
                                      </div>

                             <div class="form-check d-flex mb-4 ">
                             <input type="checkbox" name="remember"  class="form-check-input me-2" id="remember" class="mr-2">
                             <label for="remember">Remember me</label>
                           </div>
                           <center>
                            <button type="submit" class="btn btn-danger btn-rounded btn-block">
                                {{ __('Login') }}
                            </button>
                        </center>         
                                            </center>
                                            <hr>  
                                        </form> 
                                           <label class="text-sm-center mb-2">Vous n'avez pas encore un compte ? inscrivez-vous dès maintenant et profitez du site d´emploi et de recrutement Aji tkhdem</label>
                                           <center> <a name=""class="btn btn-danger btn-rounded btn-block " href="{{ route('RegisterCandidat') }}">Inscription</a></center>
                                          
                               
                                        </form> 
                             
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
                </section>
                        </div>
@include('layouts.footer')
@endsection