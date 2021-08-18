@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')


<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Offres :</h2>
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
            <h3 class="fs-4 mb-3">Valider - Refuser - Mettre en attente : Les offres</h3>
            <div class="col table-responsive ">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >Date</th>
                            <th scope="col">Sociéte</th>
                            <th scope="col">Intitulé du poste</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($AllOffres->count())
                        @foreach ($AllOffres as $offre)
                        <tr>
                            <th scope="row">{{Carbon\Carbon::parse($offre->created_at)->format('Y-m-d')}}</th>
                            <td>{{$offre->societe}}</td>
                            <td>{{$offre->Titre}}</td>
                            <td>{{$offre->Etat}}</td>
                            <td>
                                <ul class="list-inline m-0">
                                    @if ($offre->Etat != "Active")
                                    <form action="{{ route('Activer', [  $offre->id ]) }}" method="Post" class="d-inline">
                                        @CSRF
                                        @method('PUT')
                                    <li class="list-inline-item">
                                      <button type="submit" class="btn btn-success btn-sm rounded-0" title="Valider"><i class="far fa-thumbs-up"></i></button>
                                    </li>
                                    </form>
                                    @endif
                                    @if ($offre->Etat != "en attente")
                                    <form action="{{ route('En_attente', [  $offre->id ]) }}" method="Post" class="d-inline">
                                        @CSRF
                                        @method('PUT')
                                <li class="list-inline-item">
                
                                    <button class="btn btn-warning btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="Mettre en attente"><i class="far fa-pause-circle"></i></button>
                                </form>
                                  </li>
                                  @endif

                                  @if ($offre->Etat != "Refuser")
                                  <form action="{{ route('Refuser', [  $offre->id ]) }}" method="Post" class="d-inline">
                                    @CSRF
                                    @method('PUT')
                                <li class="list-inline-item">
                                    <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="Refuser"><i class="far fa-thumbs-down"></i></button>
                                </li>
                                  </form>
                                @endif
                                  
                                {{-- @endif --}}
                              
                            </ul>
                            </td>
                        </tr>

                     
                        @endforeach
                        
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                          <strong>Aucun annonce trouver</strong>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{ $AllOffres->links() }}

    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>



@endsection