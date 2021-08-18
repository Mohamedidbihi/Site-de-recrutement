
@extends('layouts.app')
@section('content')
@include('layouts.header')
<div class="blank"></div>
<div class="blank"></div>
<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<img src="../img/Sans-titre---1.png" alt="Maxwell Admin">
				</div>
				<h5 class="user-name">{{ $candidats[0]->nom }} {{ $candidats[0]->prenom }}</h5>
				<h6 class="user-email">{{ auth()->user()->email }}</h6>
			</div>
			<div class="about">
				<h5>Date creation du compte</h5>
				<p>{{$candidats[0]->datec}}</p>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-danger">Identification</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <form action="{{ route('candidats.update') }}" method="Post"  enctype="multipart/form-data">
			@CSRF
			@method('PUT')
				<div class="form-group">
					<label for="Nom">Nom</label>
					<input type="text" class="form-control" id="Nom"  name="nom" value="{{ $candidats[0]->nom }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="prenom">Prenom</label>
					<input type="text" class="form-control" id="eMail" name="prenom" value="{{ $candidats[0]->prenom }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="telehone">Telephone</label>
					<input type="number" class="form-control" name="telephone"  value="{{ $candidats[0]->telephone }}">
				</div>
			</div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="teled">Telephone domicile</label>
        <input type="number" class="form-control"  name="telephoned" value="{{ $candidats[0]->telephoned }}">
      </div>
    </div>
 
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="date">Date Naissance</label>
        <input type="date" class="form-control"  name="dn" value="{{  $candidats[0]->dn }}">
      </div>
    </div>
    </div>
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-danger">Address</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="adresse">Adress</label>
					<input type="text" name="adresse" class="form-control" value=" {{ $candidats[0]->adresse }}">
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="region">region</label>
          <select id="region" name="region" class="form-control" value="{{old('region')}}">
            <option value="" selected disabled>Select region</option>
             @foreach($regions as $key => $region)
             <option value="{{ $key}}" {{ $candidats[0]->region_id == $key ? "selected" :""}}>{{ $region}}</option>
             @endforeach
             </select> 
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="ville">ville</label>
          <select name="ville" id="ville"  class="form-control" value="{{old('ville')}}">
          <option value="{{$candidats[0]->ville_id}}">{{$candidats[0]->Ville}}</option>   
        </select>
				</div>
			</div>
		</div>

    <div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-danger">Formation</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="diplome">Diplome</label>
				  <select name="diplome"  class="form-control" value="{{old($candidats[0]->diplome_id)}}">
          
            @foreach($diplomes as $key => $diplome)
            <option value="{{ $key}}" {{ $candidats[0]->diplome_id == $key ? "selected" :""}}>{{ $diplome}}</option>
            {{-- <option value="{{$key}}"> {{$diplome}}</option> --}}
            @endforeach 
        </select>  
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="secteur">Secteur d'activité</label>
				  <select  name="secteur" id="secteur"   class="form-control"  value="{{old('secteur')}}">
            <option value="" selected disabled>Select secteurs</option>
            @foreach($secteurs as $key => $secteur)
            <option value="{{ $key}}" {{ $candidats[0]->secteur_id == $key ? "selected" :""}}>{{ $secteur}}</option>
            @endforeach
        </select> 
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="metier">Metier</label>
          <select name="metier" id="metier" class="form-control" >
                  <option value="{{$candidats[0]->metier_id}}">{{$candidats[0]->metier}}</option>               
          </select>  
				</div>
			</div>
		</div>
    <a href="{{url('Cvs/'.$candidats[0]->filecv)}}"  target="_blank">{{$candidats[0]->filecv}}</a><br>
<input type="file" name="filecv" accept="application/pdf">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
          <br>
			 
					<input type="submit" id="submit" name="submit" class="btn btn-warning" value="Update">
        </form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<div class="blank"></div>
  
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
  
      $('#ville').append(`<option value="${element['id']}">${element['Ville']}</option>`);console.log()
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