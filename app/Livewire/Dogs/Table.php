<?php

namespace App\Livewire\Dogs;

use App\Models\Dog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public ?string $search = null;
    protected int $perPage = 10;

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
            'dogs' => $this->getDogsQuery(),
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
     * @return LengthAwarePaginator
     */
    private function getDogsQuery(): LengthAwarePaginator
    {
        return Dog::query()
            ->with('mainBreed', 'secondBreed', 'latestAppointment')
            ->when($this->search !== null, function (Builder $query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('owner', function (Builder $ownerQuery) {
                        $ownerQuery->where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('secondary_phone', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('name', 'LIKE', '%' . $this->search . '%');
                    })
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
            ->paginate($this->perPage);
    }

    /**
     * Display skeleton during component loading.
     *
     * @param array $params
     * @return View
     */
    public function placeholder(array $params = []): View
    {
        $params['rows'] = $this->perPage;
        $params['search'] = true;

        return view('livewire.placeholders.table-skeleton', $params);
    }
}
