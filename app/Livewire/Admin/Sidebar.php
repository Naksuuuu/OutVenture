<?php

namespace App\Livewire\Admin;

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

        // Emit event ke layout dengan value
        $this->dispatch('sidebar-toggled', isCollapsed: $this->isCollapsed);
    }

    public function render()
    {
        return view('components.admin.sidebar');
    }
}
