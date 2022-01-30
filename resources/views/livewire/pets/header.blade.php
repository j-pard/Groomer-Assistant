<header class="row">
    <div class="col-12 col-md-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
                @if ($pet->exists)
                    <h2 class="mb-0 text-nowrap">{!! $pet->getName() !!}</h2>
                @else
                    <h2 class="mb-0 text-nowrap"><span class="text-pink">N</span>ouveau chien</h2>
                @endif
            </div>

            {{-- More actions on small screens --}}
            <div class="d-md-none">
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
            </div>
        </div>

    </div>

    <div class="col-12 col-md-7 mx-0 px-0">
        @if ($pet->exists)
            <ul class="nav nav-pills d-flex justify-content-center justify-content-md-end align-items-center px-0 mx-0" id="pills-tab">
                @foreach ($navigation as $nav => $route)
                    <li class="nav-item mx-1">
                        <a href="{{ $route }}" class="nav-link {{ Request::url() == $route ? 'active' : '' }}">{{ $nav }}</a>
                    </li>
                @endforeach
    
                {{-- More actions on medium screens --}}
                <li class="nav-item d-none d-md-block">
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
