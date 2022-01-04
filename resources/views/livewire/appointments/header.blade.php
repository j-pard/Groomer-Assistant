<header>
    <div class="d-flex justify-content-between align-items-center">
        <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
        @if ($model->exists)
            <h2 class="mb-0 text-nowrap"><span class="text-pink">R</span>endez-vous</h2></h2>
        @else
            <h2 class="mb-0 text-nowrap"><span class="text-pink">N</span>ouveau rendez-vous</h2>
        @endif
    </div>

    @if ($model->exists)
        <ul class="nav nav-pills d-flex justify-content-end align-items-center" id="pills-tab">
                <li class="nav-item">
                    <div class="dropdown d-flex align-items-center">
                        <i class="fas fa-cog text-secondary h4 m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a type="button" class="dropdown-item" title="Supprimer le rendez-vous" data-confirm="Le rendez-vous sera supprimé définitivement." data-confirm-action="@this.deleteAppointment()">
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