<?php

namespace App\Http\Resources\DataTables;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class DataTableResource extends JsonResource
{
    protected $user;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($resource, User $user)
    {
        parent::__construct($resource);

        $this->user = $user;
    }
}
