<?php

namespace App\Http\Livewire\Customers;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Header extends Component
{
    public Model $model;

    public string $backUrl;
    public string $title;
    public array $navigation;
    public array $menu;

    /**
     * Mount component
     */
    public function mount(string $backUrl)
    {
        $this->backUrl = $backUrl;
        $this->title = $this->model->firstname . ' ' . $this->model->lastname;
        $this->navigation = $this->getNavigation();
        $this->menu = $this->getMenuActions();
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.nav.model-header');
    }

    /**
     * Return array of navigation links
     *
     * @return array
     */
    private function getNavigation() :array
    {
        $nav = [
            'Détails' => route('customers.edit', ['customer' => $this->model]),
        ];

        if ($this->model->exists) {
            $nav['Rendez-vous'] = route('customers.appointments', ['customer' => $this->model]);
        }

        return $nav;
    }

    /**
     * Return array of menu actions
     *
     * @return array
     */
    private function getMenuActions() :array
    {
        if ($this->model->exists) {
            return [
                [
                    'type' => 'modal',
                    'target' => '#customerApptModal',
                    'icon' => 'fas fa-calendar-plus',
                    'text' => 'Nouveau RDV',
                ],

                [
                    'type' => 'divider',
                ],

                [
                    'type' => 'action',
                    'target' => 'deleteCustomer',
                    'icon' => 'fas fa-trash',
                    'text' => 'Supprimer',
                ]
            ];
        }

        return [];
    }
}
