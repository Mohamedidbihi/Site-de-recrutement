@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')

 <!-- Page Content --> 
 <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Dashboard</h2>
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
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">{{ $active }}</h3>
                        <p class="fs-5">Offre active</p>
                    </div>
                    <i class="far fa-address-card fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">{{ $en_attente }}</h3>
                        <p class="fs-5">Offre en attente</p>
                    </div>
                    <i
                        class="fas fa-business-time fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">{{ $refused}}</h3>
                        <p class="fs-5">Offre refusée</p>
                    </div>
                    <i class="fas fa-archive fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

    

        <div class="row my-5">
            <h3 class="fs-4 mb-3">Les offres de la semaine :</h3>
            <div class="col table-responsive ">
                <table class="table table-white bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >Date </th>
                            <th scope="col">Intitulé du poste</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Nbr candidats postulé</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($offresweek->count())
                        @foreach ($offresweek as $offre)
                        <tr>
                            <th>{{Carbon\Carbon::parse($offre->created_at)->format('Y-m-d')}}</th>
                            <td>{{$offre->Titre}}</td>
                            <td>{{$offre->ville}}</td>
                            <td>{{$offre->Etat}}</td>
                            <td><span class="badge  bg-danger badge-pill">{{$offre->nbr}}</span></td>
                        </tr>
                    
                        @endforeach
                      
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                          <strong>Aucun annonce cette semaine</strong>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{ $offresweek->links() }}
    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>


@endsection