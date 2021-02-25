<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PetsTable extends TableComponent
{
    use HtmlComponents;

    public function query() : Builder
    {
        return Pet::where('status', '!=', 'dead');
    }

    public function columns() : array
    {
        return [
            
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('Propriétaire', 'customer.lastname')
                ->searchable()
                ->sortable()
                ->format(function(Pet $model) {
                    $customer = $model->customer;
                    return $this->html('<span>' . $customer->lastname . ' ' . $customer->firstname . '</strong>');
                }),
        ];
    }
}