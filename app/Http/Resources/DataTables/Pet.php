<?php

namespace App\Http\Resources\DataTables;

use Carbon\Carbon;

class Pet extends DataTableResource
{
    public function toArray($request)
    {
        $customer = strtoupper($this->customer->lastname) . ' ' . ucfirst($this->customer->firstname);

        return [
            'type' => $this->type === 'dog' ? '<i class="fas fa-dog h5"></i>' : '<i class="fas fa-cat h4"></i>',
            'name' => e($this->name),
            'customer_id' => e($customer),
            'created_at' => e(Carbon::parse($this->created_at)->format('d-m-Y')),
            'id' => '<a href="' . route("editPet", ['pet' => $this]) . '"><i class="fas fa-eye h4"></i></a>',
        ];
    }
}