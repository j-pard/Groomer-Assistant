<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends TableComponent
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
            Column::make('')
                ->format(function(Customer $model) {
                    return view('manager.partials.menu-row', [
                        'items' => [
                            'edit' => [
                                'icon' => 'fas fa-pen',
                                'url' => route('customers.edit', ['customer' => $model])
                            ]
                        ]
                    ]);
                }),
            
            Column::make('Nom', 'lastname')
                ->searchable()
                ->sortable(),

            Column::make('Prénom', 'firstname')
                ->searchable()
                ->sortable(),

            Column::make('Ville', 'city')
                ->searchable()
                ->sortable(),

            Column::make('Mobile', 'phone')
                ->searchable(),
        ];
    }
}
