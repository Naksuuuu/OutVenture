<?php

namespace App\Livewire\Admin\Template;

use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    public $isCollapsed = false;
    public string $activeRoute = '';

    public function mount()
    {
        $this->isCollapsed = session('sidebar_collapsed', false);
        $this->activeRoute = request()->route()?->getName() ?? '';
    }

    #[On('toggle-sidebar')]
    public function toggleSidebar()
    {
        $this->isCollapsed = !$this->isCollapsed;
        session(['sidebar_collapsed' => $this->isCollapsed]);


        $this->dispatch('sidebar-toggled', isCollapsed: $this->isCollapsed);
    }

    public function getMenuItems()
    {
        $menuItems = [
            [
                'route' => 'admin.dashboard',
                'icon' => 'layout-dashboard',
                'label' => 'Dashboard',
                'matchExact' => true,
            ],
            [
                'route' => 'admin.products.index',
                'icon' => 'handbag',
                'label' => 'Products',
                'matchExact' => false,
            ],
            [
                'route' => 'admin.categories.index',
                'icon' => 'library-big',
                'label' => 'Categories',
                'matchExact' => false,
            ],
            [
                'route' => 'admin.brands.index',
                'icon' => 'award',
                'label' => 'Brands',
                'matchExact' => false,
            ],
            [
                'route' => 'admin.sizes.index',
                'icon' => 'ruler',
                'label' => 'Sizes',
                'matchExact' => false,
            ],
            [
                'route' => 'admin.orders.index',
                'icon' => 'receipt',
                'label' => 'Orders',
                'matchExact' => false,
            ],
            [
                'route' => 'admin.colors.index',
                'icon' => 'paint-bucket',
                'label' => 'Colors',
                'matchExact' => false,
            ],
        ];

        if (auth()->check() && auth()->user()->role === 'superadmin') {
            $menuItems[] = [
                'route' => 'admin.users.index',
                'icon' => 'user',
                'label' => 'Admin Users',
                'matchExact' => false,
            ];
        }

        return $menuItems;
    }

    public function render()
    {
        return view('livewire.admin.template.sidebar', [
            'menuItems' => $this->getMenuItems()
        ]);
    }
}
