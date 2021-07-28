@extends('layouts.app')
@section('content')
@include('layouts.header')
  

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
              <form>
                  <div class="mb-3">
                      <label class="form-label">Titre</label>
                      <input type="text" class="form-control" id="username" name="username" value="" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Description</label>
                      <input type="text" class="form-control" id="password" name="password" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Secteur</label>
                    <input type="text" class="form-control" id="password" name="password" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Diplome</label>
                  <input type="text" class="form-control" id="password" name="password" />
              </div>
              <div class="mb-3">
                <label class="form-label">Experience</label>
                <input type="text" class="form-control" id="password" name="password" />
            </div>
            <div class="mb-3">
              <label class="form-label">Type Contrat </label>
              <input type="text" class="form-control" id="password" name="password" />
          </div>
          <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" class="form-control" id="password" name="password" />
        </div>
        <div class="mb-3">
          <label class="form-label">Etat</label>
          <input type="text" class="form-control" id="password" name="password" />
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
        @foreach ($annonces as $annonce)
        <tr>
        <th scope="row">{{$annonce->created_at->format('d/m/Y')}}</th>
        <td><a href="../views/Offre_info.html">{{$annonce->Titre}}</a></td>
        <td>{{$annonce->Etat}}</td>
        <td>
            <ul class="list-inline m-0">
            <li class="list-inline-item">
              {!! '<a href="' . route('detail', $annonce->id) . '"class="btn btn-primary btn-sm rounded-0" title="Afficher"><i class="fa fa-table"></i></a>' !!}
            </li>
           
            @if($annonce->Etat === "en attente")
            <li class="list-inline-item">
                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fa fa-edit"></i></button>
            </li>
            <li class="list-inline-item">
              <form action="{{ route('annonce.destroy',$annonce) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top" title="Supprimer"><i class="fa fa-trash"></i></button>
              </form>
              </li>
       
              
            @endif
          
        </ul>
        </td>
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
  <div class="blank"></div> <div class="blank"></div> <div class="blank"></div>


@include('layouts.footer')
@endsection