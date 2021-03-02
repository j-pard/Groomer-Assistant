<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CustomersTable extends TableComponent
{
    use HtmlComponents;

    public $sortField = 'lastname';
    public $sortDirection = 'asc';

    public function query() : Builder
    {
        return Customer::whereNotNull('id');
    }

    public function columns() : array
    {
        return [
            
            Column::make('Nom', 'lastname')
                ->searchable()
                ->sortable(),

            Column::make('Prénom', 'firstname')
                ->searchable()
                ->sortable(),

            Column::make('Ville', 'city')
                ->searchable()
                ->sortable(),

            Column::make('Mobile', 'mobile')
                ->searchable(),
        ];
    }
}
