<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Delete extends Component
{
    public $category;
    public $errorMessage = '';

    public function mount($category)
    {
        $this->category = Category::findOrFail($category);
    }

    public function delete()
    {
        $this->errorMessage = '';

        if ($this->category->products()->exists()) {
            $this->errorMessage = 'Kategori masih memiliki produk, hapus atau pindahkan produk terlebih dahulu.';
            return;
        }

        $this->category->delete();

        session()->flash('success', 'Kategori berhasil dihapus!');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.category.delete');
    }
}
