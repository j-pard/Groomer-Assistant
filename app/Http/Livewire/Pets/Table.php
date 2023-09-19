<?php

namespace App\Http\Livewire\Pets;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Table extends DataTableComponent
{
    public ?string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';
    public array $perPageAccepted = [25];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('pets.edit', $row);
            });
    }
    
    public function builder(): Builder
    {
        return Pet::query()
            ->when($this->getAppliedFilterWithValue('status'), fn ($query, $status) => $query->where('status', $status));
    }
    
    public function setTableClass(): ?string
    {
        return 'table custom-table';
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
                        case 'private':
                            return '<span class="badge rounded-pill bg-success">Privé</span>';
                            break;

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
                ->html(),

            Column::make('Actions', 'id')
                // ->addClass('text-center')
                ->searchable()
                ->format(function($id) {
                    return '<div class="actions-container">
                        <a href="' . route('pets.edit', ['pet' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>
                        <a href="' . route('pets.appointments', ['pet' => $id]) . '" class="btn btn-outline-info btn-sm mx-2">RDV</a>
                    </div>';
                })
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'Tous',
                    'active' => 'Actifs',
                    'private' => 'Privés',
                    'not-coming' => 'Ne viennent plus',
                    'dead' => 'Décédés',
                ]),
        ];
    }   
}
