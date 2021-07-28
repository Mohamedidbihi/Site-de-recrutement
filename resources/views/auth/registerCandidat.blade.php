@extends('layouts.app')
@section('content')
@include('layouts.header')

  <!-- blocA -->
  <div class="blocA">
    <div class="blank"></div>
</div>
<!-- Form-->
<div class="banner-image w-100 vh-200 d-flex justify-content-center align-items-center ">
<section class="intro pt-4">
    <div class="mask d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 mx-auto ">
                  @if(session('status'))
                  <div class="alert alert-danger text-center" role="alert">
                      {{ session('status') }}
                  </div>
                  @endif
                    <div class="card" style="border-radius: 1rem;">
                        <div class="card-body p-5" id='form'>
                            <h1 class="mb-5 text-center Titre_formulaire">FORMULAIRE CANDIDATURE :<br>J'entre les informations les plus importantes pour pouvoir postuler immédiatement.
                            </h1>
                            <form  class="formsignup" method="post" action="{{ route('RegisterCandidat')}}" enctype="multipart/form-data">
                              @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">                             
                                      <div class="form-outline">
                                        <label class="form-label">Civilité : *</label>
                                        <select class=" form-control" name="civilite">
                                            <option value="" disabled selected>-Selectionner-</option>
                                            <option value="M">M</option>
                                            <option value="Mme">Mme</option>
                                            <option value="Mlle">Mlle</option>
                                        </select> 
                                        @error('civilite')
                                        <div class="text-danger">
                                        {{ $message }}
                                        </div>
                                        @enderror      
                                    </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <div class="form-outline">
                                          <label class="form-label" >Nom : *</label>
                                            <input type="text" class="form-control " name="nom" placeholder="Votre nom"   />
                                            @error('nom')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" >Prenom : *</label>
                                          <input type="text" class="form-control " name="prenom" placeholder="Votre prenom"/>
                                          @error('prenom')
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
                                        <label class="form-label" for="email">Email : *</label>
                                          <input type="email" name="email"  class="form-control @error('email')border border-danger" @enderror" value="{{old('email')}}"/>
                                          @error('email')
                                              <div class="text-danger">
                                              {{ $message }}
                                              </div>
                                              @enderror
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4 mb-4">
                                    <div class="form-outline">
                                      <label class="form-label" for="password" >Mot de passe : *</label>
                                        <input type="password" class="form-control @error('password') border border-danger" @enderror " name="password"/>
                                             @error('password')
                                              <div class="text-danger">
                                              {{ $message }}
                                              </div>
                                              @enderror
                                    </div>
                                </div>
                                
                                  <div class="col-12 col-md-4 mb-4">
                                    <div class="form-outline">
                                      <label class="form-label" for="password_confirmaton" >Confirmer mot de pass : *</label>
                                        <input type="password" class="form-control @error('password') border border-danger" @enderror" name="password_confirmation"/>
                                       
                                    </div>
                                </div>
                              </div>

                                <div class="row">
                                  <div class="col-12 col-md-4 mb-4">
                                      <div class="form-outline">
                                        <label class="form-label" >Date de naissance : *</label>
                                          <input type="date" name="dn" class="form-control @error('dn')border border-danger" @enderror" value="{{old('dn')}}"   />
                                          @error('dn')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror  
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4 mb-4">
                                    <div class="form-outline">
                                      <label class="form-label" >Telephone portable : *</label>
                                        <input type="number" name="telephone" placeholder="Telephone" class="form-control @error('telephone')border border-danger" @enderror" value="{{old('telephone')}}"/>
                                        @error('telephone')
                                        <div class="text-danger">
                                        {{ $message }}
                                        </div>
                                        @enderror                                 
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4">
                                  <div class="form-outline">
                                    <label class="form-label" >Telephone domicile : </label>
                                      <input type="number" name="telephoned" placeholder="Telephone" class="form-control" value="{{old('telephoned')}}"/>
                                      @error('telephoned')
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
                                      <label class="form-label" >Adresse : *</label>
                                        <input type="text"  name="adresse"  class="form-control @error('adresse')border border-danger" @enderror" value="{{old('adresse')}}" />
                                        @error('adresse')
                                        <div class="text-danger">
                                        {{ $message }}
                                        </div>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-4">
                                  <div class="form-outline">
                                    <label class="form-label" >Region: *</label>
                                    <select id="region" name="region" class="form-control @error('region')border border-danger" @enderror" value="{{old('region')}}">
                                      <option value="" selected disabled>Select region</option>
                                       @foreach($regions as $key => $region)
                                       <option value="{{$key}}"> {{$region}}</option>
                                       @endforeach
                                       </select> 
                                       @error('region')
                                       <div class="text-danger">
                                       {{ $message }}
                                       </div>
                                       @enderror                                            
                                  </div>
                                </div>
                                <div class="col-12 col-md-3 mb-4">
                                  <div class="form-outline">
                                    <label class="form-label" >Ville: *</label>
                                      <select name="ville" id="ville"  class="form-control @error('ville')border border-danger" @enderror" value="{{old('ville')}}"></select>
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
                                  <label class="form-label" >Diplome : *</label>
                                  <select name="diplome"  class="form-control @error('diplome')border border-danger" @enderror" value="{{old('diplome')}}">
                                    <option value="" disabled selected>-Selectionner-</option>
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
                              <div class="col-12 col-md-3 mb-4">
                                <div class="form-outline">
                                  <label class="form-label" >Secteur d'activité : *</label>
                                  <select  name="secteur" id="secteur"   class="form-control @error('secteur')border border-danger" @enderror" value="{{old('secteur')}}">
                                    <option value="" selected disabled>Select secteurs</option>
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
                              <div class="col-12 col-md-3 mb-4">
                                <div class="form-outline">
                                  <label class="form-label" >Metier : *</label>
                                  <select name="metier" id="metier"   class="form-control @error('metier')border border-danger" @enderror" value="{{old('metier')}}">
                                 
                                </select>   
                                @error('metier')
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
                                <label class="form-label" >Joindre votre CV personnel(pdf) : :*
                                </label>
                                <input type="file"  name="filecv" id="filecv"  class="form-control @error('filecv')border border-danger" @enderror" value="{{old('filecv')}}" accept="application/pdf"  /> 
                                @error('filecv')
                                <div class="text-danger">
                                {{ $message }}
                                </div>
                                @enderror                                            
                              </div>
                            </div>
                        </div>
                        <!-- Checkbox -->
<div class="form-check d-flex justify-content-center mb-4">
  <input name="check"  class="form-check-input me-2" type="checkbox" value=""/>
  @error('check')
  <div class="text-danger">
  {{ $message }}
  </div>
  @enderror   

  <label  for="conditions">
    j'ai lu et j'accepte <a href="#">les conditions générales </a> d'utilisation, notamment la mention relative à la protection des données personnelles.
  </label>
</div>

   <!-- Submit button -->
                                        <center><button type="submit"
                                                 name="Register"class="btn btn-danger btn-rounded btn-block ">S'inscrire</button>
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
<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>
  $(document).ready(function () {
  $('#region').on('change', function () {
  let id = $(this).val();
  $('#ville').empty();
  $('#ville').append(`<option value="0" disabled selected>Processing...</option>`);
  $.ajax({
  type: 'GET',
  url: 'RecupVilles/' + id,
  success: function (response) {
  var response = JSON.parse(response);
  console.log(response);   
  $('#ville').empty();
  $('#ville').append(`<option value="0" disabled selected>Select ville*</option>`);
  response.forEach(element => {
      $('#ville').append(`<option value="${element['id']}">${element['Ville']}</option>`);
      });
  }
});
});
});

$(document).ready(function () {
  $('#secteur').on('change', function () {
  let id = $(this).val();
  $('#metier').empty();
  $('#metier').append(`<option value="0" disabled selected>Processing...</option>`);
  $.ajax({
  type: 'GET',
  url: 'RecupMetier/' + id,
  success: function (response) {
  var response = JSON.parse(response);
  console.log(response);   
  $('#metier').empty();
  $('#metier').append(`<option value="0" disabled selected>Select metier*</option>`);
  response.forEach(element => {
      $('#metier').append(`<option value="${element['id']}">${element['metier']}</option>`);
      });
  }
});
});
});
</script>
@endsection