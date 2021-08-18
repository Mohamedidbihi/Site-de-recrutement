@extends('layouts.app')
@section('content')
<img  class=" w-100" src="../img/mark-fletcher-brown-nN5L5GXKFz8-unsplash - Copie.jpg"></img>
<div class="texta">
  <h2><span class="titre-col">AJI TKHDEM ! </span></h2> 
  <h2>Trouvez votre futur job parmi <span class="titre-col">19807</span> postes ouverts</h2>
</div>
  <section class="search-sec">
    <div class="container">
        <form action="{{ route('AccueillCandidat') }}" method="get">
          @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <input type="text" class="form-control search-slt" placeholder="Recherche mots-cles" autocomplete="off" name="MotCles"  value="{{Request::old('MotCles')}}">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                          <select class="form-control search-slt" name="region">
                            <option selected disabled>Par Region</option>
                            @foreach($regions as $key => $region)
                            <option value="{{$key}}" {{ old('region') == $key ? "selected" : "" }}> {{$region}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                            <select class="form-control search-slt" name="secteur"   value="{{Request::old('secteur')}}">
                                <option selected disabled>Par Fonction</option>
                                @foreach($secteurs as $key => $secteur)
                                <option value="{{$key}}" {{ old('secteur') == $key ? "selected" : "" }}> {{$secteur}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                          <button type="submit" class="btn btn-danger wrn-btn">RECHERCHER</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
</div>

@include('layouts.header')

<div class="Offres table-responsive">
<table class="table">
  
  <thead class="table-danger">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Intitulé du poste</th>
      <th scope="col">Ville</th>
    </tr>
  </thead>
  <tbody>
    @if ($offres->count())
@foreach ($offres as $offre)
<tr>
<th scope="row"> {{Carbon\Carbon::parse($offre->created_at)->format('Y-m-d')}}</th>
<td>
<form action="{{ route('Offre.infos',$offre->id) }}" method="GET" name="form">
  @csrf
  <input class="text-danger" style="border:none;padding: 0;border: none; background: none;" type="submit" value="{{ $offre->Titre}}">
</form> 
</td>

{{-- <a href="../views/Offre_info.html">{{$offre->Titre}}</a></td> --}}
<td>{{$offre->ville}}</td>
</tr>
@endforeach
@else
<div class="alert alert-danger text-center" role="alert">
  <strong>Aucun annonce</strong>
</div>
@endif
  </tbody>
</table>
</div>
{{ $offres->links()}}

@include('layouts.footer')
@endsection