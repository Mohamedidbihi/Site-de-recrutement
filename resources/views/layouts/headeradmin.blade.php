<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                class="fas fa-users-cog"></i>Aji tkhdem !</div>
        <div class="list-group list-group-flush my-3">
            <a href="{{ route('Dashboard') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-clipboard me-2"></i>Dashboard</a>
            <a href=" {{ URL::to('/Dashboard/offres')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-project-diagram me-2"></i>Offres entreprises</a>
                    <a href=" {{ URL::to('/Dashboard/offres/Ajitkhdem')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-bullhorn me-2"></i>Aji tkhdem Offres</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="far fa-address-book me-2"></i>Candidats</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                    class="fas fa-fax me-2"></i>Entreprises</a>
                <form action="{{ route('logout')}} " method="post">    
                        @csrf
            <button type="submit" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                    class="fas fa-power-off me-2"></i>Logout</button>
                </form>
        </div>
    </div>