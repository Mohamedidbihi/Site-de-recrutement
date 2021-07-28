@extends('layouts.app')

@section('content')

<video  class=" w-100 vh-0" src="../img/video.mp4"muted loop autoplay></video>
<div class="text">
  <h2><span class="titre-col">AJI TKHDEM ! </span></h2> 
  <h3>Recrutez plus facilement les bons candidats pour votre entreprise</h3>
  <a href="#">Publier une annonce</a>
</div>
@include('layouts.header')
    <!-- blocA -->
    <div class="blocA text-center">
<h1 class="animated shake">Une solution pour chaque besoin RH</h1>
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
    <h1 class="text-center"> AJI TKHDEM ! UTILISE UN SYSTÈME RIGOUREUX ET SÉLECTIF</h1><br><br>
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
@include('layouts.footer')
@endsection