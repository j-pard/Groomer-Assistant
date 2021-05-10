<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Traits\Options;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentsTable extends TableComponent
{
    use HtmlComponents, Options;

    public $sortField = 'time';
    public $sortDirection = 'desc';
    public $pet;

    public function mount($pet)
    {
        $this->pet = $pet;
    }

    public function query() : Builder
    {
        return Appointment::where('pet_id', $this->pet->id);
    }

    public function columns() : array
    {
        return [
            Column::make('')
            ->format(function(Appointment $model) {
                return $this->html(
                    
                    '<div class="text-center" type="button" data-bs-toggle="modal" data-bs-target="">
                        <i class="fas fa-eye"></i>
                    </div>'
                );
            }),

            Column::make('Date', 'time')
                ->searchable()
                ->sortable()
                ->format(function(Appointment $model) {
                    return Carbon::parse($model->time)->format('m-d-Y h:i');
                }),

            Column::make('Status', 'status')
                ->sortable()
                ->format(function(Appointment $model) {
                    switch ($model->status) {
                        case 'paid':
                            return $this->html(
                                '<span class="badge rounded-pill bg-success">Payé</span>'
                            );
                            break;

                        case 'not-paid':
                            return $this->html(
                                '<span class="badge rounded-pill bg-danger">Non payé</span>'
                            );
                            break;

                        case 'cancelled':
                            return $this->html(
                                '<span class="badge rounded-pill bg-warning">Annulé</span>'
                            );
                            break;
                        
                        default:
                            return $this->html(
                                '<span class="badge rounded-pill bg-secondary">Planifié</span>'
                            );
                            break;
                    }
                }),
        ];
    }
}
