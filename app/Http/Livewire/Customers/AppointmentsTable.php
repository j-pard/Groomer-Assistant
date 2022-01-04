<?php

namespace App\Http\Livewire\Customers;

use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class AppointmentsTable extends DataTableComponent
{
    public Customer $customer;
    
    // Default sorting
    public string $defaultSortColumn = 'time';
    public string $defaultSortDirection = 'desc';

    public bool $showPerPage = false;
    public array $perPageAccepted = [25];

    public function query(): Builder
    {
        return Appointment::where('customer_id', $this->customer->id)
            ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
    }
    
    public function columns(): array
    {
        return [
            
            Column::make('Date', 'time')
                ->searchable()
                ->sortable()
                ->format(function($value) {
                    return Carbon::parse($value)->format('d-m-Y H:i');
                }),
            
            Column::make('Nom', 'pet.name')
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->format(function($value) {
                    switch ($value) {
                        case 'planned':
                            return '<span class="badge rounded-pill bg-secondary">Planifié</span>';
                            break;

                        case 'not paid':
                            return '<span class="badge rounded-pill bg-danger">Non payé</span>';
                            break;

                        case 'cancelled':
                            return '<span class="badge rounded-pill bg-warning">Annulé</span>';
                            break;
                        
                        default:
                            return '<span class="badge rounded-pill bg-success">Payé</span>';
                            break;
                    }
                })
                ->asHtml(),

            Column::make('Prix €', 'price')
                ->sortable(),

            Column::make('', 'id')
                ->searchable()
                ->format(function($id) {
                    return '<a href="' . route('appointments.edit', ['appointment' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>';
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
                    'planned' => 'Planifiés',
                    'not paid' => 'Non payés',
                    'cancelled' => 'Annulés',
                ]),
        ];
    }   
}
