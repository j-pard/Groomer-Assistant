<?php

namespace App\DataTables;

use App\Http\Resources\DataTables\Pet as PetResource;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->setTransformer(function ($item) {
                $item->menu = [
                    [
                        //
                    ],
                ];

                return PetResource::make($item, Auth::user())->resolve();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pet $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pets-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'name',
                'title' => 'Nom',
                'responsivePriority' => 0,
            ],
            [
                'data' => 'customer_id',
                'title' => 'Propriétaire',
                'responsivePriority' => 0,
            ],
            [
                'data' => 'created_at',
                'title' => 'Date de création',
                'responsivePriority' => 0,
            ],
            [
                'data' => 'id',
                'title' => 'Actions',
                'responsivePriority' => 0,
                'searchable' => false,
                'orderable' => false,
            ],

        ];
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        // Default order: ASC
        $params['order'] = [[1, 'asc']];

        return $params;
    }
}
