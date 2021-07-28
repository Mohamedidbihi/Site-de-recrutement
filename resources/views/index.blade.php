@extends('layouts.app')

@section('content')
 
<video  class=" w-100 vh-0" src="../img/video.mp4"muted loop autoplay></video>
<div class="text">
  <h2><span class="titre-col">AJI TKHDEM ! </span></h2> 
  <h2>Trouver Le Job Qui Vous Convient <span class="titre-col">Vraiment</span> </h2>
  <a href="{{ route("RegisterEntreprise") }}"> Postulez dès maintenant</a>
</div>
</div>
@include('layouts.header')
<!-- blocA -->
<div class="blocA text-center">
<h1 class="animated shake">Besoin de recruter ?<br>
On s'occupe de vous.</h1>
<a href="#" class=" ">DECOUVRIR NOS SOLUTIONS</a>
</div></div>
<div class="blank"></div>
<!-- BlocB -->
<div class="container blocB">
<div class="row">
<div class="col-md-6 pic1 ">
<img src="../img/leon-vbxyFxlgpjM-unsplash.jpg" width="100%" height="100%">
</div>
<div class="col-md-6">
<br><br>
<h1 class="text-center">Site d'emploi au Maroc</h1><br><br>
<p class="text-center"><span>AJI TKHDEM</span>  simplifie la publication d’offres d’emploi pour les recruteurs et offre aux candidats un ensemble d’outils pour leur permettre de trouver un emploi plus rapidement.</p>
</div>
</div>
</div>
<div class="blank"></div>
<!-- blocC -->
<div class="container blocC">
<div class="row">
<div class="col-md-6">
  <br><br>
  <h1 class="text-center">QUI SOMMES-NOUS ?</h1><br><br>
  <p class="text-center"><span>AJI TKHDEM</span> est une entreprise de travail temporaire et de recrutement. Chargée de mettre à la disposition des entreprises clientes des salariés intérimaires pour effectuer des missions précises. Distinguée par ses engagements de réactivité, de proximité, de confiance et de sécurité.</p>
</div>
<div class="col-md-6 pic1"><video src="../img/video (1).mp4" width="100%" height="100%" muted loop autoplay></video> </div>
</div>
</div>
<div class="blank"></div>
<div class="container blocD text-white">
<div class="row">
<div class="cont1 col-md-6 text-center">
<h4>Je suis candidat</h4>
<img src="../img/administrator-512.png" alt="CANDIDAT" style="width: 140px ;height: 120PX;"><br><br>
<p>La création d'un compte candidat permet de postuler aux offres d'emploi, publier un CV...</p>
<a href="{{ route("RegisterCandidat") }}" type="button" class="btn btn-light">Candidat</a>
</div>
<div class="cont2 col-md-6 text-center">
<h4>Je suis entreprise</h4>
<img src="../img/checked-user-512.png" alt="entreprise"  style="width: 140px ;height: 120px;"><br><br>
<p>La création d'un compte entreprise permet de publier des offres d'emploi...</p>
<a href="{{ route("RegisterEntreprise") }}" type="button" class="btn btn-light">Entreprise</a>
</div>
</div>
</div>
<div class="blank"></div>
@include('layouts.footer')


@endsection