@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')


<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Entreprises  :</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
     
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <h3 class="fs-4 mb-3">Les entreprise inscris à AJI tkhdem !</h3>
            <section class="search-sec2">
                <div class="container">
                    <form action="{{ route('SearchEntreprise') }}" method="get">
                      @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                        <input type="text" class="form-control search-slt" placeholder="Recherche mots-cles" autocomplete="off" name="MotCles"  value="{{Request::old('MotCles')}}">
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                                      <select class="form-control search-slt" name="region">
                                        <option selected disabled>Par Region</option>
                                        @foreach($regions as $key => $region)
                                        <option value="{{$key}}" {{ old('region') == $key ? "selected" : "" }}> {{$region}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" name="secteur"   value="{{Request::old('secteur')}}">
                                            <option selected disabled>Par secteur</option>
                                            
                                            @foreach($secteurs as $key => $secteur)
                                            <option value="{{$key}}" {{ old('secteur') == $key ? "selected" : "" }}> {{$secteur}}</option>
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
                <table class="table bg-white rounded shadow-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Societe</th>
                            <th scope="col">Raison sociale</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Fax</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Adresse</th>
                        </tr>
                    </thead>             
                    <tbody>
                        @if ($entreprises->count())
                        @foreach ($entreprises as $entreprise)
                        <tr>
                            <th>{{$entreprise->societe }} </th>
                            <td>{{$entreprise->secteur}}</td>
                            <td>{{$entreprise->telephone}}</td>
                            <td>{{$entreprise->fax}}</td>
                            <td>{{$entreprise->ville}}</td>
                            <td>{{$entreprise->adresse}}</td>
                        </tr>
                        @endforeach
                      
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                          <strong>Aucun Entreprise trouvé</strong>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{ $entreprises->links() }}
    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>

@endsection