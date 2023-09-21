<?php

namespace App\Livewire\Dogs;

use App\Models\Dog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public ?string $search = null;

    /**
     * Define rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'search' => 'string',
        ];
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.table', [
            'dogs' => $this->getDogsQuery()->paginate(10),
        ]);
    }

    /**
     * React to "updated" hooks.
     *
     * @param string $property
     * @return void
     */
    public function updated(string $property)
    {
        if ($property === 'search') {
            $this->search = trim(strtolower($this->search));
            $this->resetPage();
            $this->dispatch('clearable', show: strlen($this->search) > 0);
        }
    }

    public function clearSearch()
    {
        $this->search = null;
    }

    /**
     * Generate dogs query with search parameters.
     *
     * @return Builder
     */
    private function getDogsQuery(): Builder
    {
        return Dog::query()
            ->with('mainBreed', 'secondBreed')
            ->when($this->search !== null, function (Builder $query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('owner_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('owner_phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('owner_secondary_phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('owner_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere(function (Builder $q) {
                        $q->whereHas('mainBreed', function (Builder $breedQuery) {
                            $breedQuery->where('breed', 'LIKE', '%' . $this->search . '%');
                        })
                        ->orWhereHas('secondBreed', function (Builder $breedQuery) {
                            $breedQuery->where('breed', 'LIKE', '%' . $this->search . '%');
                        });
                    });
            })
            ->orderBy('name', 'ASC')
            ->orderBy('owner_name', 'ASC');
    }
}
