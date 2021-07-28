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
                              <h1 class="mb-5 text-center Titre_formulaire"> Recrutons ensemble votre talent idéal :
                              </h1>
                              @if(session('status'))
                              <div class="alert alert-danger text-center" role="alert">
                                  {{ session('status') }}
                              </div>
                              @endif
                              <form  class="formsignup"  method="post" action="{{ route('publierannonce')}}" >
                                @csrf
                                  <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Titre : *</label>
                                            <input type="text" name="titre" placeholder="Titre" class="form-control @error('titre')border border-danger" @enderror" value="{{old('titre')}}"/>
                                            @error('titre')
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
                                          <label class="form-label" >Description : *</label>
                                            <textarea name="description" id="description" cols="50" rows="10" ></textarea>
                                            @error('description')
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
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" >Niveau d'etude: *</label>
                                                <select id="diplome"  name="diplome" class="form-control @error('diplome')border border-danger" @enderror" value="{{old('diplome')}}">
                                                  <option value="" selected disabled>-Selectionner-</option>
                                                  @foreach($diplomes as $key => $diplome)
                                            <option value="{{$key}}"> {{$diplome}}</option>
                                            @endforeach
                                                   </select>
                                                                    
                                              @error('diplome')
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
                                                <label class="form-label" >Niveau d'experience: *</label>
                                                <select id="experience"  name="experience" class="form-control @error('experience')border border-danger" @enderror" value="{{old('experience')}}">
                                                  <option value="" selected disabled>-Selectionner-</option>
                                                  <option value="Jeune">Jeune diplômé (0 - 1 an)</option>
                                                  <option value="Junior">Junior (2 - 4 ans)</option>
                                                  <option value="Confirmé">Confirmé ( 5 - 9 ans)</option>
                                                  <option value="expérimenté">Senior ou expérimenté (Plus de 10 ans)</option>
                                                   </select>
                                                                    
                                              @error('experience')
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
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" >Type Offre: *</label>
                                            <select id="Typeoffre"  name="Typeoffre" class="form-control @error('Typeoffre')border border-danger" @enderror" value="{{old('Typeoffre')}}">
                                              <option value="" selected disabled>-Selectionner-</option>
                                              <option value="1">CDI</option>
                                              <option value="2">CDD</option>
                                              <option value="3">INTERIM</option>
                                              <option value="4">STAGE</option>
                                               </select>
                                                                
                                          @error('Typeoffre')
                                          <div class="text-danger">
                                          {{ $message }}
                                          </div>
                                          @enderror
                                          </div>
                                  </div>
                                </div>
               
                             </div>

     <!-- Submit button -->
                                          <center><button type="submit" name="Publier" class="btn btn-danger btn-rounded btn-block ">Publier</button>
                    
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