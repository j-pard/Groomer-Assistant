<?php

namespace App\Http\Livewire\Pets;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PetsTable extends DataTableComponent
{
    public string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';

    public function query(): Builder
    {
        return Pet::query();
    }
    
    public function columns(): array
    {
        return [
            Column::make('Nom', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Race', 'mainBreed.breed')
                ->sortable()
                ->searchable(),

            Column::make('Croisement', 'secondBreed.breed')
                ->sortable()
                ->searchable(),

            Column::make('Propiétaire', 'customer.lastname')
                ->sortable()
                ->searchable(),
                
            Column::make('Propiétaire', 'customer.firstname')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->format(function($value) {
                    switch ($value) {
                        case 'not-coming':
                            return 'Ne vient plus';
                            break;

                        case 'dead':
                            return 'Décédé';
                            break;
                        
                        default:
                            return 'Actif';
                            break;
                    }
                }),

            Column::make('', 'id')
                ->searchable()
                ->format(function($id) {
                    return '<a href="' . route('pets.edit', ['pet' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>';
                })
                ->asHtml(),
        ];
    }
}
