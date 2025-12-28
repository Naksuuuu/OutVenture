<?php

namespace App\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;

class Delete extends Component
{
    public $color;
    public $errorMessage = '';

    protected $listeners = ['variant-deleted' => 'refreshColor', 'variant-created' => 'refreshColor'];

    public function mount($color)
    {
        $this->color = Color::findOrFail($color);
    }

    public function refreshColor()
    {
        $this->color = Color::findOrFail($this->color->id);
        $this->errorMessage = '';
    }

    public function delete()
    {
        $this->errorMessage = '';

        if ($this->color->productVariants()->exists()) {
            $variantCount = $this->color->productVariants()->count();
            $this->errorMessage = "Warna tidak dapat dihapus karena masih digunakan pada {$variantCount} varian produk!";
            return;
        }

        $this->color->delete();

        session()->flash('success', 'Warna berhasil dihapus!');

        return redirect()->route('admin.colors.index');
    }

    public function render()
    {
        return view('livewire.admin.color.delete');
    }
}
