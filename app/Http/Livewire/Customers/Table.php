<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    // Default sorting
    public string $defaultSortColumn = 'lastname';
    public string $defaultSortDirection = 'asc';

    public bool $showPerPage = false;
    public array $perPageAccepted = [25];

    public function query(): Builder
    {
        return Customer::query();
    }
    
    public function columns(): array
    {
        return [
            Column::make('Nom', 'lastname')
                ->sortable()
                ->searchable(),
                
            Column::make('Prénom', 'firstname')
                ->sortable()
                ->searchable(),

            Column::make('Ville', 'city')
                ->searchable()
                ->sortable(),

            Column::make('Mobile', 'phone')
                ->searchable(),

            Column::make('', 'id')
                ->searchable()
                ->format(function($id) {
                    return '
                        <a href="' . route('customers.edit', ['customer' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>
                        <a href="' . route('customers.appointments', ['customer' => $id]) . '" class="btn btn-outline-info btn-sm mx-2">Rendez-vous</a>
                    ';
                })
                ->asHtml(),
        ];
    }
}
