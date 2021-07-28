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
                              <h1 class="mb-5 text-center Titre_formulaire">Bienvenue sur l’espace de création de votre compte Entreprise :
                              </h1>
                              @if(session('status'))
                              <div class="alert alert-danger text-center" role="alert">
                                  {{ session('status') }}
                              </div>
                              @endif
                              <form  class="formsignup"  method="post" action="{{ route('RegisterEntreprise')}}" >
                                @csrf
                                  <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Sociéte : *</label>
                                            <input type="text" name="societe" placeholder="Sociéte" class="form-control @error('metier')border border-danger" @enderror" value="{{old('societe')}}"/>
                                            @error('societe')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-8 mb-4">
                                          <div class="form-outline">
                                            <label class="form-label" > Raison sociale : *</label>
                                              <input type="text" name="raison" placeholder="Raison" class="form-control @error('metier')border border-danger" @enderror" value="{{old('raison')}}" />
                                              @error('raison')
                                              <div class="text-danger">
                                              {{ $message }}
                                              </div>
                                              @enderror
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Secteur d'activité: *</label>
                                          <select name="secteur" class="form-control @error('secteur')border border-danger" @enderror" value="{{old('secteur')}}"   >
                                            <option value="" disabled selected>-Selectionner-</option>
                                            @foreach($secteurs as $key => $secteur)
                                            <option value="{{$key}}"> {{$secteur}}</option>
                                            @endforeach
                                        </select>    
                                        @error('secteur')
                                        <div class="text-danger">
                                        {{ $message }}
                                        </div>
                                        @enderror                                      
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-6 mb-4">
                                          <div class="form-outline">
                                              <label class="form-label" >Telephone : *</label>
                                              <input type="number"  name="telephone" class="form-control @error('telephone')border border-danger" @enderror" value="{{old('telephone')}}"  />
                                              @error('telephone')
                                              <div class="text-danger">
                                              {{ $message }}
                                              </div>
                                              @enderror
                                            </div>
                                        </div>
                                    </div>
                                        
                                  <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Fax : *</label>
                                            <input type="number" name="fax" class="form-control @error('fax')border border-danger" @enderror" value="{{old('fax')}}"/>  
                                            @error('fax')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror                                      
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" >Ville: *</label>
                                            <select id="ville"  name="ville" class="form-control @error('ville')border border-danger" @enderror" value="{{old('ville')}}">
                                              <option value="" selected disabled>-Selectionner-</option>
                                               @foreach($villes as $key => $ville)
                                               <option value="{{$key}}"> {{$ville}}</option>
                                               @endforeach
                                               </select>
                                                                                  
                                          @error('ville')
                                          <div class="text-danger">
                                          {{ $message }}
                                          </div>
                                          @enderror
                                          </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Email : *</label>
                                            <input type="email" name="email" class="form-control @error('email')border border-danger" @enderror" value="{{old('email')}}"/>
                                            @error('email')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" >Mot de passe : *</label>
                                          <input type="password" class="form-control" name="password" />
                                          @error('password')
                                          <div class="text-danger">
                                          {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                    <div class="col-12 col-md-4 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" >Confirmer mot de passe : *</label>
                                          <input type="password" class="form-control"  name="password_confirmation"/>
                                         
                                      </div>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="col-12 col-md-12 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" >Adresse : *</label>
                                          <input type="text" name="adresse" class="form-control @error('adresse')border border-danger" @enderror" value="{{old('adresse')}}"/>
                                          @error('adresse')
                                          <div class="text-danger">
                                          {{ $message }}
                                          </div>
                                          @enderror
                                      </div>
                                  </div>
                              </div>

                          <!-- Checkbox -->
  <div class="form-check d-flex justify-content-center mb-4">
    <input
      class="form-check-input me-2"
      type="checkbox"
      value=""
      id="form4Example4"
      
    />
    <label  for="form4Example4">
      j'ai lu et j'accepte <a href="#">les conditions générales </a> d'utilisation, notamment la mention relative à la protection des données personnelles.
    </label>
  </div>

     <!-- Submit button -->
                                          <center><button type="submit" name="inscrire"class="btn btn-danger btn-rounded btn-block ">S'inscrire</button>
                    
                                          </center><br><br>
                                          <hr> 
                                         
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