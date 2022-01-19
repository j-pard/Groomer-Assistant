<header class="row">
    <div class="col-10 col-md-8 d-flex align-items-center">
        <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
        @if ($model->exists)
            <h2 class="mb-0 text-nowrap"><span class="text-pink">R</span>endez-vous</h2></h2>
        @else
            <h2 class="mb-0 text-nowrap"><span class="text-pink">N</span>ouveau rendez-vous</h2>
        @endif
    </div>

    @if ($model->exists)
        <div class="col-2 col-md-4 d-flex justify-content-end align-items-center">
            <a type="button" class="btn" title="Supprimer le rendez-vous" data-confirm="Le rendez-vous sera supprimé définitivement." data-confirm-action="@this.deleteAppointment()">
                <i class="fas fa-trash text-secondary"></i>
            </a>
        </div>
    @endif
</header>