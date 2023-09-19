<?php

namespace App\Http\Livewire\Dogs;

use App\Enums\DogStatus;
use App\Models\Dog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Table extends DataTableComponent
{
    public ?string $defaultSortColumn = 'name';
    public string $defaultSortDirection = 'asc';
    public array $perPageAccepted = [25];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    
    public function builder(): Builder
    {
        return Dog::query();
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

            Column::make('Propiétaire', 'owner_name')
                ->searchable(),

            Column::make('Race', 'mainBreed.breed')
                ->searchable(),

            BooleanColumn::make('Croisé(e)', 'second_breed_id')
                ->setCallback(function(?string $value, $row) {
                    return $value !== null;
                }),

            Column::make('Status', 'status')
                ->format(function($value) {
                    return '<span class="badge rounded-pill bg-' . DogStatus::getColor($value) . '">' . DogStatus::getText($value) . '</span>';
                })
                ->html(),

            Column::make('Actions', 'id')
                ->searchable()
                ->format(function($id) {
                    return '<div class="actions-container">
                        <a href="' . route('pets.edit', ['pet' => $id]) . '" class="btn btn-outline-primary btn-sm mx-2">Editer</a>
                    </div>';
                })
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options(['' => 'Tous'] + DogStatus::pluckAll())
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
            SelectFilter::make('Croisé')
                ->options([
                    '' => 'Tous',
                    '1' => 'Oui',
                    '0' => 'Non',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->whereNotNull('second_breed_id');
                    } elseif ($value === '0') {
                        $builder->whereNull('second_breed_id');
                    }
                }),
        ];
    }   
}
