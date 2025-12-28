<?php

namespace App\Livewire\Admin\Variant;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public $variant;
    public $product;
    public $errorMessage = '';

    protected $listeners = ['spec-events' => 'refreshVariant'];

    public function mount($variant, $product)
    {
        $this->variant = ProductVariant::findOrFail($variant);
        $this->product = $product;
    }

    public function refreshVariant()
    {
        $this->variant = ProductVariant::findOrFail($this->variant->id);
        $this->errorMessage = '';
    }

    public function delete()
    {
        $this->errorMessage = '';

        $this->variant->refresh();

        if ($this->variant->specs()->exists()) {
            $this->errorMessage = 'Varian masih memiliki spesifikasi, hapus spesifikasi terlebih dahulu.';
            return;
        }

        if ($this->variant->image) {
            Storage::disk('public')->delete($this->variant->image);
        }

        $this->variant->delete();
        
        $this->dispatch('variant-delete-success');
        $this->dispatch('variant-deleted');
        $this->dispatch('variant-created');
        $this->dispatch('notify', type: 'success', message: 'Varian berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.admin.variant.delete');
    }
}
