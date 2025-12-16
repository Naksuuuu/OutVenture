<?php

namespace App\Http\Livewire;
namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    // Properti publik yang menyimpan status collapse.
    // Jika true, sidebar akan berukuran kecil (collapsed).
    public $isCollapsed = false; 

    public function mount()
    {
        // Secara opsional, ambil status dari session atau cookie jika ada
        $this->isCollapsed = session('sidebar_collapsed', false); 
    }

    public function toggleSidebar()
    {
        // Membalik status collapse
        $this->isCollapsed = !$this->isCollapsed;
        
        // Simpan status baru ke session agar tetap tersimpan setelah refresh
        session(['sidebar_collapsed' => $this->isCollapsed]);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}