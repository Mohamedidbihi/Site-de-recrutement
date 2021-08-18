<!-- Navbar  -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container">
      <a class="navbar-brand" href="#">  <img
        src="../img/Sans-titre---1.png"
        height="60"
        width="120"
        alt=""
        loading="lazy"
      /></a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon bg-dark"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="mx-auto"></div>
        <ul class="navbar-nav">
          @auth
          @if (Auth::user()->role == 'entreprise')
          <li class="nav-item ">
            <a class="nav-link nav-title " href="{{ route('AccueillEntreprise') }} ">Accueill </a>
          </li>
          @else
          <li class="nav-item ">
            <a class="nav-link nav-title " href="{{ route('AccueillCandidat') }}"">Accueill </a>
          </li> 
          @endif
          @endauth
          @guest     
          <li class="nav-item ">
            <a class="nav-link nav-title " href="{{ route('home') }}"">Accueill </a>
          </li> 
     
          <li class="nav-item ">
            <a class="nav-link nav-title" href="#">QUI SOMME NOUS ?</a>
          </li>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle nav-title"  href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               ESPACE CANDIDAT
              </a>
              <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item nav-title" href="#">CHOISIR SMCP</a></li>
                <li><a class="dropdown-item nav-title" href="#">CONSEIL EMPLOI</a></li>
                <li><a class="dropdown-item nav-title" href="#">GUIDE DE L'INTERIM</a></li>
               
              </ul>
            </li>
        </div>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-title" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 ESPACE ENTREPRISE
                </a>
                <ul class="dropdown-menu dropdown-menu " aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item nav-title" href="#">NOS ATOUTS</a></li>
                  <li><a class="dropdown-item nav-title" href="#">NOS METHODES</a></li>
                  <li><a class="dropdown-item nav-title" href="#">NOS SERVICES</a></li>
                  <li><a class="dropdown-item nav-title" href="#">NOS PROCEDURES DE RECRUTEMENT</a></li>
                </ul>
              </li>
          </div>
        
              
          <li class="nav-item ">
            <a class="btn btn-danger bt" href="{{ route('RegisterEntreprise') }}">PUBLIER UNE ANNONCE</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link nav-title text-danger" href="{{ route('RegisterCandidat') }}" >S'INSCRIRE </a>
          </li>
          <li class="nav-item ">
            <a  href="{{ route('login') }}" class="btn btn-danger bt">Login<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
              <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
              <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg></a>
          </li>
          @endguest

          @auth     
          @if(auth()->user()->role === 'candidat')
          <li class="nav-item ">
            <button type="button" class="btn btn-danger bt">Les offres à la une</button>
          </li>
          <li class="nav-item ">
            <a class="nav-link nav-title text-danger"  href="{{ route('moncompte') }}">Mon compte</a>
          </li>
         @endif
         @if(auth()->user()->role === 'entreprise')
         <li class="nav-item ">
          <a class="btn btn-danger bt" href="{{ route('publierannonce') }}" >Publier une annnonce</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link nav-title text-danger" href="{{ route('mesannonces') }}">Mes annonces</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link nav-title text-danger"  href="{{ route('moncompterh') }}">Mon compte</a>
        </li>
        @endif
          
          <li class="nav-item ">  
           <form action="{{ route('logout')}} " method="post" class="inline">
             @csrf
             <button type="submit" class="btn btn-danger bt">Deconnexion</button>
           </form>
         </li>
       @endauth
              
        

          
        </ul>
      </div>
    </div>
  </nav>