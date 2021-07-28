@extends('layouts.app')
@section('content')
@include('layouts.headeradmin')

<!-- Modal -->
<div class="modal fade-scrollable" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Nouvelle offre sur AJI TKHDEM !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="post" action="{{ route('addoffre')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" >Titre : *</label>
                        <input type="text" name="titre" placeholder="Titre" class="form-control @error('titre')border border-danger" @enderror" value="{{old('titre')}}"/>
                        @error('titre')
                        <div class="text-danger">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Description : *</label>
                                            <textarea name="description" id="description" cols="50" rows="5" ></textarea>
                                            @error('description')
                                            <div class="text-danger">
                                            {{ $message }}
                                            </div>
                                            @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Secteur d'activité: *</label>
                        <select name="secteur" class="form-control @error('secteur')border border-danger" @enderror" value="{{old('secteur')}}"   >
                          <option value="" disabled selected>-Selectionner-</option>
                          @foreach($secteurs as $key => $secteur)
                          <option value="{{$key}}"> {{$secteur}}</option>
                          @endforeach
                      </select>    
                      @error('secteur')
                      <div class="text-danger">
                      {{ $message }}
                      </div>
                      @enderror    
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Niveau d'etude: *</label>
                        <select id="diplome"  name="diplome" class="form-control @error('diplome')border border-danger" @enderror" value="{{old('diplome')}}">
                          <option value="" selected disabled>-Selectionner-</option>
                          @foreach($diplomes as $key => $diplome)
                    <option value="{{$key}}"> {{$diplome}}</option>
                    @endforeach
                           </select>
                                            
                      @error('diplome')
                      <div class="text-danger">
                      {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Niveau d'experience: *</label>
                        <select id="experience"  name="experience" class="form-control @error('experience')border border-danger" @enderror" value="{{old('experience')}}">
                          <option value="" selected disabled>-Selectionner-</option>
                          <option value="Jeune">Jeune diplômé (0 - 1 an)</option>
                          <option value="Junior">Junior (2 - 4 ans)</option>
                          <option value="Confirmé">Confirmé ( 5 - 9 ans)</option>
                          <option value="expérimenté">Senior ou expérimenté (Plus de 10 ans)</option>
                           </select>
                                            
                      @error('experience')
                      <div class="text-danger">
                      {{ $message }}
                      </div>
                      @enderror    
                    </div>

                    <div class="mb-3">
                        <label class="form-label" >Ville: *</label>
                                            <select id="ville"  name="ville" class="form-control @error('ville')border border-danger" @enderror" value="{{old('ville')}}">
                                              <option value="" selected disabled>-Selectionner-</option>
                                               @foreach($villes as $key => $ville)
                                               <option value="{{$key}}"> {{$ville}}</option>
                                               @endforeach
                                               </select>
                                                                                  
                                          @error('ville')
                                          <div class="text-danger">
                                          {{ $message }}
                                          </div>
                                          @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" >Type Offre: *</label>
                        <select id="Typeoffre"  name="Typeoffre" class="form-control @error('Typeoffre')border border-danger" @enderror" value="{{old('Typeoffre')}}">
                          <option value="" selected disabled>-Selectionner-</option>
                          <option value="1">CDI</option>
                          <option value="2">CDD</option>
                          <option value="3">INTERIM</option>
                          <option value="4">STAGE</option>
                           </select>
                                            
                      @error('Typeoffre')
                      <div class="text-danger">
                      {{ $message }}
                      </div>
                      @enderror   
                    </div>
                  
                    <div class="modal-footer d-block">
                        <center><button type="submit" class="btn btn-danger ">Ajouter</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-arrow-alt-circle-left primary-text fs-1 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Aji tkhdem :</h2>
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
            <h3 class="fs-4 mb-3">Les offres de AJI tkhdem !</h3>
            <div class="col">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalForm"><i class="fas fa-plus"></i> Nouvelle Offre</button>
                @if(session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >Date</th>
                            <th scope="col">Intitulé du poste</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($AjitkhdemOffres->count())
                        @foreach ($AjitkhdemOffres as $offre)
                        <tr>
                            <th scope="row">{{Carbon\Carbon::parse($offre->created_at)->format('Y-m-d')}}</th>
                            <td>{{$offre->Titre}}</td>
                            {{-- <td>{{$offre->societe}}</td> --}}
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
                                @endif
                                  
                                {{-- @endif --}}
                              
                            </ul>
                            </td>
                        </tr>

                        {{-- {{ $AllOffres->links() }} --}}
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

    </div>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>



@endsection