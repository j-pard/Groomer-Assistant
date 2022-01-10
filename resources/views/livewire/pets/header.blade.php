<header class="row">
    <div class="col-12 col-md-6">
        <div class="d-flex align-items-center">
            <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
        @if ($pet->exists)
            <h2 class="mb-0 text-nowrap">{{ $pet->name }}</h2>
        @else
            <h2 class="mb-0 text-nowrap"><span class="text-pink">N</span>ouveau chien</h2>
        @endif
        </div>
    </div>

    <div class="col-12 col-md-6">
        @if ($pet->exists)
            <ul class="nav nav-pills d-flex justify-content-end align-items-center" id="pills-tab">
                @foreach ($navigation as $nav => $route)
                    <li class="nav-item">
                        <a href="{{ $route }}" class="nav-link {{ Request::url() == $route ? 'active' : '' }}">{{ $nav }}</a>
                    </li>
                @endforeach
    
                    <li class="nav-item">
                        <div class="dropdown d-flex align-items-center">
                            <i class="fas fa-cog text-secondary h4 m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true"></i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if (isset($pet->customer))
                                    <li>
                                        <a href="{{ route('pets.appointment', ['pet' => $pet]) }}" type="button" class="dropdown-item" title="Ajouter un rendez-vous">
                                            <i class="fas fa-calendar-plus text-secondary me-3"></i>
                                            Nouveau RDV
                                        </a>
                                    </li>
    
                                    <li><hr class="dropdown-divider"></li>
                                @endif
    
                                <li>
                                    <a type="button" class="dropdown-item" title="Supprimer le chien" data-confirm="Le chien et son historique seront supprimés définitivement." data-confirm-action="@this.deletePet()">
                                        <i class="fas fa-trash text-secondary me-3"></i>
                                        Supprimer
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            </ul>
        @endif
    </div>
</header>
