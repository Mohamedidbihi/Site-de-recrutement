
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
				<h5 class="user-name">{{ $entreprises[0]->societe }}</h5>
				<h6 class="user-email">{{ auth()->user()->email }}</h6>
			</div>
			<div class="about">
				<h5>Date creation du compte</h5>
				<p>{{$entreprises[0]->datec}}</p>
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
				<form action="{{ route('entreprise.update') }}" method="Post">
					@CSRF
					@method('PUT')
				<div class="form-group">
					<label for="Nom">Sociéte</label>
					<input type="text" class="form-control" id="societe"  name="societe" value="{{ $entreprises[0]->societe }}">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="prenom">Raison sociale</label>
                    <input type="text" class="form-control" id="raison"  name="raison" value="{{ $entreprises[0]->Raison }}">
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
					<input type="number" class="form-control" name="telephone"  value="{{ $entreprises[0]->telephone }}">
				</div>
			</div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
      <div class="form-group">
        <label for="Fax">Fax</label>
        <input type="number" class="form-control"  name="fax" value="{{ $entreprises[0]->fax }}">
      </div>
    </div>
 
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-danger">Address</h6>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="adresse">Adress</label>
					<input type="name" name="adresse" class="form-control" value=" {{ $entreprises[0]->adresse }}">
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="region">region</label>
          <select id="region" name="region" class="form-control" value="{{old('region')}}">
            <option value="" selected disabled>Select region</option>
             @foreach($regions as $key => $region)
             <option value="{{ $key}}" {{ $entreprises[0]->region_id == $key ? "selected" :""}}>{{ $region}}</option>
             @endforeach
             </select> 
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="ville">ville</label>
          <select name="ville" id="ville"  class="form-control" value="{{old('ville')}}">
          <option value="{{$entreprises[0]->ville_id}}">{{$entreprises[0]->Ville}}</option>   
        </select>
				</div>
			</div>
		</div>
        <div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mt-3 mb-2 text-danger">Secteur d'activité</h6>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
				<div class="form-group">
					<label for="secteur">Secteur</label>
				  <select  name="secteur" id="secteur"   class="form-control"  value="{{old('secteur')}}">
            <option value="" selected disabled>Select secteurs</option>
            @foreach($secteurs as $key => $secteur)
            <option value="{{ $key}}" {{ $entreprises[0]->secteur_id == $key ? "selected" :""}}>{{ $secteur}}</option>
            @endforeach
        </select> 
				</div>
			</div>

		</div>
    
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
          <br>
			 
					<button type="submit" id="submit" name="submit" class="btn btn-warning">Update</button>
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

</script>
@endsection