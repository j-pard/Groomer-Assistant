<?php

namespace App\Http\Livewire\Settings\Breeds;

use App\Models\Breed;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends TableComponent
{
    use HtmlComponents;

    public $sortField = 'breed';
    public $sortDirection = 'asc';

    public function query() : Builder
    {
        return Breed::whereNotNull('id')->orderBy('breed');
    }

    public function columns() : array
    {
        return [
            Column::make('')
                ->format(function(Breed $model) {
                    return $this->html(
                        '<button type="button" class="btn btn-transparent mt-2 js-breed-btn" data-breed="' . $model->id . '">
                            <i class="far fa-save h3 text-pink"></i>
                        </button>'
                    );
                }),

            Column::make('Race', 'breed')
                ->searchable()
                ->sortable()
                ->format(function(Breed $model) {
                    return $this->html(
                        '<div>
                            <input class="form-control my-2" type="text" name="breed" id="breed_' . $model->id . '" value="' . $model->breed . '" min="2" max="100">
                        </div>'
                    );
                }),
        ];
    }
}
