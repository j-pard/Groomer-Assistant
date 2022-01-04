<?php

namespace App\Http\Livewire\Pets;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PetsTable extends DataTableComponent
{
    // Default sorting
    public string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';

    // Default filters
    public array $filters = ['status' => 'active'];

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
                ->searchable(),

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

            Column::make('', 'id')
                ->searchable()
                ->format(function($id) {
                    return '<a href="' . route('pets.edit', ['pet' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>';
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
