@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')


<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Les candidats :</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>{{auth()->user()->email}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Mon compte</a></li>
                        <li><a class="dropdown-item" href="#">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row my-5">
            <h3 class="fs-4 mb-3">Les candidats de AJI tkhdem !</h3>
            <section class="search-sec2">
                <div class="container">
                    <form action="{{ route('SearchCandidat') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">

                                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" name="region">
                                            <option selected disabled>Par Region</option>

                                            @foreach($regions as $key => $region)
                                            <option value="{{$key}}" {{ old('region') == $key ? "selected" : "" }}>
                                                {{$region}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" name="secteur"
                                            value="{{Request::old('secteur')}}">
                                            <option selected disabled>Par secteur</option>

                                            @foreach($secteurs as $key => $secteur)
                                            <option value="{{$key}}" {{ old('secteur') == $key ? "selected" : "" }}>
                                                {{$secteur}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" name="metier"
                                            value="{{Request::old('metier')}}">
                                            <option selected disabled>Par Metier</option>

                                            @foreach($metiers as $key => $metier)
                                            <option value="{{$key}}" {{ old('metier') == $key ? "selected" : "" }}>
                                                {{$metier}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" name="diplome"
                                            value="{{Request::old('diplome')}}">
                                            <option selected disabled>Par Diplome</option>

                                            @foreach($diplomes as $key => $diplome)
                                            <option value="{{$key}}" {{ old('diplome') == $key ? "selected" : "" }}>
                                                {{$diplome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                        <button type="submit" class="btn btn-danger wrn-btn">RECHERCHER</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <div class="col table-responsive ">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nom complet</th>
                            <th scope="col">ville</th>
                            <th scope="col">Diplome</th>
                            <th scope="col">Metier</th>
                            <th scope="col">Cv</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($candidats->count())
                        @foreach ($candidats as $candidat)
                        <tr>
                            <th>{{$candidat->nom }} {{$candidat->prenom}}</th>
                            <td>{{$candidat->ville}}</td>
                            <td>{{$candidat->diplome}}</td>
                            <td>{{$candidat->metier}}</td>
                            <td><a href="{{url('Cvs/'.$candidat->filecv)}}" target="_blank">{{$candidat->filecv}}</a>
                            </td>
                        </tr>

                        @endforeach

                        @else
                        <div class="alert alert-danger text-center" role="alert">
                            <strong>Aucun candidat trouvé</strong>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{ $candidats->links() }}
    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>

@endsection
