<?php

namespace App\Livewire\Dogs;

use App\Models\Dog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Timeline extends Component
{
    public Dog $dog;

    /**
     * Call on component mount.
     *
     * @param Dog $dog
     * @return void
     */
    public function mount(Dog $dog) 
    {
        $this->dog = $dog;
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.timeline', [
            'items' => $this->getDogsTimelineQuery(),
        ]);
    }

    /**
     * Generate dogs query with search parameters.
     *
     * @return Collection
     */
    private function getDogsTimelineQuery(): Collection
    {
        return $this->dog->appointments()
            ->orderBy('time', 'DESC')
            ->get();
    }

    /**
     * Display skeleton during component loading.
     *
     * @param array $params
     * @return View
     */
    public function placeholder(array $params = []): View
    {
        $params['rows'] = 10;
        $params['search'] = false;
        $params['pagination'] = false;

        return view('livewire.placeholders.table-skeleton', $params);
    }
}
