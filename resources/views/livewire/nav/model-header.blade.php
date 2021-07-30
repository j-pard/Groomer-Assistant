<header>
    <div class="d-flex justify-content-between align-items-center">
        <a class="btn btn-transparent circle" href="{{ $backUrl }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
        @if ($model->exists)
            <h2 class="mb-0 text-nowrap">{{ $title }}</h2>
        @endif
    </div>

    <ul class="nav nav-pills d-flex justify-content-end align-items-center" id="pills-tab">
        @foreach ($navigation as $nav => $route)
            <li class="nav-item">
                <a href="{{ $route }}" class="nav-link {{ Request::url() == $route ? 'active' : '' }}">{{ $nav }}</a>
            </li>
        @endforeach

        @if ($model->exists)
            <li class="nav-item">
                <div class="dropdown d-flex align-items-center">
                    <i class="fas fa-cog text-secondary h4 m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true"></i>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($menu as $item)
                            <li>
                                @switch($item['type'])
                                    @case('divider')
                                        <hr class="dropdown-divider">
                                        @break

                                    @case('modal')
                                        <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="{{ $item['target'] }}">
                                            <i class="{{ $item['icon'] }} text-secondary me-3"></i>{{ $item['text'] }}
                                        </a>
                                        @break

                                    @case('action')
                                        <a class="dropdown-item js-confirm-delete" role="button" data-model-id="{{ $model->id }}">
                                            <i class="{{ $item['icon'] }} text-secondary me-3"></i>{{ $item['text'] }}
                                        </a>
                                        @break
                                @endswitch
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</header>