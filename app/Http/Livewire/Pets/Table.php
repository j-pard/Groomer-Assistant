<?php

namespace App\Http\Livewire\Pets;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    // Default sorting
    public string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';

    // Default filters
    public array $filters = ['status' => 'active'];

    public bool $showPerPage = false;
    public array $perPageAccepted = [25];

    public function query(): Builder
    {
        return Pet::query()
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }
    
    public function columns(): array
    {
        return [
            Column::make('Nom', 'name')
                ->sortable()
                ->searchable()
                ->linkTo(fn($value, $column, $row) => route('pets.edit', ['pet' => $row])),

            Column::make('Race', 'mainBreed.breed')
                ->searchable(),

            Column::make('Croisement', 'secondBreed.breed')
                ->searchable(),

            Column::make('Propiétaire', 'customer.lastname')
                ->searchable(),
                
            Column::make('Propiétaire', 'customer.firstname')
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->format(function($value) {
                    switch ($value) {
                        case 'not-coming':
                            return '<span class="badge rounded-pill bg-secondary">Ne vient plus</span>';
                            break;

                        case 'dead':
                            return '<span class="badge rounded-pill bg-dark">Décédé</span>';
                            break;
                        
                        default:
                            return '<span class="badge rounded-pill bg-info">Actif</span>';
                            break;
                    }
                })
                ->asHtml(),

            Column::make('Actions', 'id')
                ->addClass('text-center')
                ->searchable()
                ->format(function($id) {
                    return '<div class="actions-container">
                        <a href="' . route('pets.edit', ['pet' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>
                        <a href="' . route('pets.appointments', ['pet' => $id]) . '" class="btn btn-outline-info btn-sm mx-2">RDV</a>
                    </div>';
                })
                ->asHtml(),
        ];
    }

    public function filters(): array
    {
        return [
            'status' => Filter::make('Status')
                ->select([
                    '' => 'Tous',
                    'active' => 'Actifs',
                    'not-coming' => 'Ne viennent plus',
                    'dead' => 'Décédés',
                ]),
        ];
    }   
}
