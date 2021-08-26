<header>
    <div class="d-flex justify-content-between align-items-center">
        <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
        @if ($customer->exists)
            <h2 class="mb-0 text-nowrap">{{ $title }}</h2>
        @else
            <h2 class="mb-0 text-nowrap"><span class="text-pink">N</span>ouveau client</h2>
        @endif
    </div>

    @if ($customer->exists)
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
                            <li>
                                <a href="{{ route('customers.appointment', ['customer' => $customer]) }}" type="button" class="dropdown-item" title="Ajouter un rendez-vous">
                                    <i class="fas fa-calendar-plus text-secondary me-3"></i>
                                    Nouveau RDV
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a type="button" class="dropdown-item" title="Supprimer le client" data-confirm="Le client et son historique seront supprimés définitivement." data-confirm-action="@this.deleteCustomer()">
                                    <i class="fas fa-trash text-secondary me-3"></i>
                                    Supprimer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
        </ul>
    @endif
</header>