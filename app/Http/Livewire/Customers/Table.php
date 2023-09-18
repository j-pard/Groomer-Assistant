<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $model = Customer::class;

    // Default sorting
    public ?string $defaultSortColumn = 'lastname';
    public string $defaultSortDirection = 'asc';

    public bool $showPerPage = false;
    public array $perPageAccepted = [25];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('customers.edit', $row);
            });
    }
    
    public function query(): Builder
    {
        return Customer::query();
    }

    public function setTableClass(): ?string
    {
        return 'table custom-table';
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

            Column::make('Info', 'has_reminder')
                ->searchable()
                ->format(function($has_reminder) {
                    if ($has_reminder) {
                        return '<div class="actions-container">
                                <i class="fas fa-envelope" title="Envoyer un message de rappel"></i>
                            </div>';
                    }
                })
                ->html(),

            Column::make('Actions', 'id')
                // ->addClass('text-center')
                ->searchable()
                ->format(function($id) {
                    return '<div class="actions-container">
                        <a href="' . route('customers.edit', ['customer' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>
                        <a href="' . route('customers.appointments', ['customer' => $id]) . '" class="btn btn-outline-info btn-sm mx-2">RDV</a>
                    </div>';
                })
                ->html(),
        ];
    }
}
