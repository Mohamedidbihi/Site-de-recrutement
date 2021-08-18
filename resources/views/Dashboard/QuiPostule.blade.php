@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')


<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Infos :</h2>
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
         
            <h3 class="fs-4 mb-3">Les informations des candidats qui sont postulée a l'offre :{{$offres[0]->Titre}}</h3>
            <div class="col table-responsive ">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >Nom Compléte</th>
                            <th scope="col">Diplome</th>
                            <th scope="col">ville</th>
                            <th scope="col">secteur</th>
                            <th scope="col">Metier</th>
                            <th scope="col">Cv</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($offres->count())
                        @foreach ($offres as $offre)
                        <tr>
                    
                            <td> {{$offre->nom}} {{$offre->prenom}} </td>
                            <td>{{$offre->diplome}}</td>
                            <td>{{$offre->ville}}</td>
                            <td>{{$offre->secteur}}</td>
                            <td>{{$offre->metier}}</td>
                            <td><a href="{{url('Cvs/'.$offre->filecv)}}"  target="_blank">{{$offre->filecv}}</a></td>
                        </tr>

                     
                        @endforeach
                        
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                          <strong>Aucun candidat postuler pour cette offre</strong>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{ $offres->links() }}

    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>



@endsection