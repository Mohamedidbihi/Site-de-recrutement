@extends('layouts.app')
@section('content')

@include('layouts.header')
<div class="container offre ">
  
      @if(session('status'))
      <div class="alert alert-danger text-center" role="alert">
          {{ session('status') }}
      </div>
      @endif
      @if(session('status1'))
      <div class="alert alert-success text-center" role="alert">
          {{ session('status1') }}
      </div>
      @endif
      <div class="blank"></div>
    <h2>OFFRE D'EMPLOI</h2>
    <hr>
   
    <div class="cont mt-0">
        <img src="../img/offre-demploi-1.png" alt="logo" width="80px" height="80px">
        <img src="../img/offre-demploi-1.png" alt="logo" width="80px" height="80px" class="mx-auto">
        <h1>{{ $offre[0]->Titre }}</h1>
        <br>
     <form action="{{ route('Postuler',$offre[0]->id) }}" method="POST"> 
         @csrf
     <input type="submit"  value="postuler" name="postuler" class="btn btn-danger ButtPost">
     </form> 
    </div>
       <div class="infos">
        <h5 class="spann">{{Carbon\Carbon::parse($offre[0]->created_at)->format('Y-m-d')}}</h5><br>
<h4>Ville :  <span class="spann">{{ $offre[0]->ville }} </span></h4><br>
<h4>Type du contrat :  <span class="spann">{{ $offre[0]->typeoffre }} </span></h4> <br>
<h4>poste:</h4>
<strong>
    {{ $offre[0]->Description }}
</strong>
<br><br>
<h4>Profil :<span class="spann"> {{ $offre[0]->Titre }} </span> </h4><br>
<h4>Experiences: <span class="spann"> {{ $offre[0]->niveau }}</span></h4><br>
       </div>
  
</div>
<div class="blank"></div>
@include('layouts.footer')
@endsection