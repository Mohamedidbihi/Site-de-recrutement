@extends('layouts.app')
@section('content')

@include('layouts.header')
<div class="container offre ">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../views/Accueill_canidat.html">Acueill</a></li>
          <li class="breadcrumb-item"><a href="#">Offres</a></li>
          <li class="breadcrumb-item active" aria-current="page">Titre_du_poste</li>
        </ol>
      </nav>
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
    <h2>OFFRE D'EMPLOI</h2>
    <hr>
    <div class="cont mt-0">
        <img src="../img/offre-demploi-1.png" alt="logo" width="80px" height="80px">
        <h1>{{ $offre[0]->Titre }}</h1>
     <form action="{{ route('Postuler',$offre[0]->id) }}" method="POST"> 
         @csrf
     <input type="submit"  value="postuler" name="postuler" class="btn btn-danger ButtPost">
     </form> 
    </div>
       <div class="infos">
        <label for="Date">{{ $offre[0]->created_at }}</label>
<p>Ville :</p><label for="ville">{{ $offre[0]->ville }}</label>
<p>Type du contrat :</p><label for="typecontrat">{{ $offre[0]->diplome }}</label>
<p>poste:</p>
<ul>
    {{ $offre[0]->Description }}
</ul>
<p>Profil :</p><label for="prof">{{ $offre[0]->Titre }}.</label>
<p>Experiences:</p><label for="exp">{{ $offre[0]->niveau }}</label>
       </div>
  
</div>

@include('layouts.footer')
@endsection