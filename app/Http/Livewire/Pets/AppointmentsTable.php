<?php

namespace App\Http\Livewire\Pets;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pet;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AppointmentsTable extends DataTableComponent
{
    public Pet $pet;
    public ?string $defaultSortColumn = 'time';
    public string $defaultSortDirection = 'desc';
    public array $perPageAccepted = [25];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Appointment::where('pet_id', $this->pet->id)
            ->when($this->getAppliedFilterWithValue('status'), fn ($query, $status) => $query->where('status', $status));
    }

    public function columns(): array
    {
        return [

            Column::make('Date', 'time')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('d-m-Y H:i');
                }),

            Column::make('Status', 'status')
                ->sortable()
                ->format(function ($value) {
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
                ->html(),

            Column::make('Prix', 'price')
                ->sortable()
                ->format(function ($price) {
                    if (!is_null($price)) {
                        return '€ ' . $price;
                    }
                }),

            Column::make('', 'id')
                ->searchable()
                ->format(function ($id) {
                    return '<a href="' . route('appointments.edit', ['appointment' => $id]) . '" class="btn btn-outline-secondary btn-sm mx-2">Editer</a>';
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
                    'planned' => 'Planifiés',
                    'not paid' => 'Non payés',
                    'cancelled' => 'Annulés',
                ]),
        ];
    }
}
