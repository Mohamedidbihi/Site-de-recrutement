@extends('layouts.app')
@section('content')
@include('layouts.header')
  

  <div class="blank"></div> <div class="blank"></div> <div class="blank"></div>
<div class="Offres">
    <table class="table ">
      <thead class="table-danger">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Intitulé du poste</th>
          <th scope="col">Etat</th> 
          <th scope="col">Action</th>   
        </tr>
      </thead>
      <tbody>
        @if ($annonces->count())
        @foreach ($annonces as $index => $annonce ) 
     
        <tr>
        <th scope="row">{{$annonce->created_at}}</th>
        <td>{{$annonce->Titre}}</td>
        <td>{{$annonce->Etat}}</td>
        <td>
            <ul class="list-inline m-0">
            <li class="list-inline-item">
              <button type="button" class="btn btn-primary btn-sm rounded-0" title="Afficher" data-bs-toggle="modal" data-bs-target="#exampleModal{{$annonce->id}}">
              <i class="fa fa-table"></i>
              </button>
            </li>
           
            @if($annonce->Etat === "en attente")

            <li class="list-inline-item">
                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fa fa-edit"></i></button>
            </li>

             <li class="list-inline-item">
            
              <form action="{{ route('annonce.destroy',$offres[$index]) }}" method="POST">

                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="Supprimer"><i class="fa fa-trash"></i></button>

              </form>
        
              </li>

            @endif

          
        </ul>
        </td>
        </tr>
        <div class="modal fade" id="exampleModal{{$annonce->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
              <form>
                  <div class="mb-3">
                      <label class="form-label">Titre</label>
                      <input type="text" class="form-control" id="Titre" readonly name="Titre" value="{{$annonce->Titre}}" />
                  </div>
                  <div class="mb-3">

                      <label class="form-label">Description</label>
                      <input type="text" class="form-control" id="Description" readonly name="Description" value="{{$annonce->Description}}"  />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Secteur</label>
                    <input type="text" class="form-control" id="Secteur" readonly name="Secteur" value="{{$annonce->secteur}}"  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Diplome</label>
                  <input type="text" class="form-control" id="Diplome" readonly name="Diplome" value="{{$annonce->diplome}}"  />
              </div>
              <div class="mb-3">
                <label class="form-label">Experience</label>
                <input type="text" class="form-control" id="Experience" readonly name="Experience" value="{{$annonce->experience}}"  />
            </div>
            <div class="mb-3">
              <label class="form-label">Type Contrat </label>
              <input type="text" class="form-control" id="typecontrat" readonly name="typecontrat" value="{{$annonce->typeoffre}}"  />
          </div>
          <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" readonly name="ville" value="{{$annonce->ville}}"  />
        </div>
        <div class="mb-3">
          <label class="form-label">Etat</label>
          <input type="text" class="form-control" id="etat" readonly name="etat" value="{{$annonce->Etat}}"  />
      </div>
                  {{-- <div class="modal-footer d-block">
                      <p class="float-start">Not yet account <a href="#">Sign Up</a></p>
                      <button type="submit" class="btn btn-warning float-end">Submit</button>
                  </div> --}}
              </form>
          </div>
      </div>
  </div>
</div>
      
        @endforeach
        @else
        <div class="alert alert-danger text-center" role="alert">
          <strong>Aucun annonce</strong>
        </div>
        @endif


      </tbody>
    </table>
  </div>
  <div class="blank"></div> <div class="blank"></div> <div class="blank"></div>


@include('layouts.footer')
@endsection