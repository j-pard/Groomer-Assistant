<?php

namespace App\Http\Livewire;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Traits\Options;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PetsTable extends TableComponent
{
    use HtmlComponents, Options;

    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function query() : Builder
    {
        return Pet::whereNotNull('id');
    }

    public function columns() : array
    {
        return [
            Column::make('')
                ->format(function(Pet $model) {
                    return view('manager.partials.menu-row', [
                        'items' => [
                            'edit' => [
                                'icon' => 'fas fa-pen',
                                'url' => route('editPet', ['pet' => $model])
                            ]
                        ]
                    ]);
                }),

            Column::make('Nom', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Race(s)', 'main_breed_id')
            ->searchable()
            ->sortable()
            ->format(function(Pet $model) {
                return $this->html(
                    '<span>' .
                    (isset($model->mainBreed) ? ($model->mainBreed->breed) : '-') .
                    (isset($model->secondBreed) ? ( ' - ' . $model->secondBreed->breed) : '') .
                    '</span>');
            }),

            Column::make('Propriétaire', 'customer.lastname')
                ->searchable()
                ->sortable()
                ->format(function(Pet $model) {
                    $customer = $model->customer;
                    
                    if (isset($customer)) {
                        return $this->html('<span>' . $customer->lastname . ' ' . $customer->firstname . '</span>');
                    }

                    return $this->html('<span>-</span>');
                }),
        ];
    }
}