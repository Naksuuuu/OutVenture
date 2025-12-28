<?php

namespace App\Livewire\Admin\Spec;

use App\Models\ProductVariantSpec;
use App\Models\ProductVariant;
use Livewire\Component;

class Delete extends Component
{
    public $spec;
    public $variant;
    public $errorMessage = '';

    public function mount(ProductVariantSpec $spec, ProductVariant $variant)
    {
        $this->spec = $spec;
        $this->variant = $variant;
    }

    public function delete()
    {
        $this->errorMessage = '';

        try {
            $this->spec->delete();
            $this->dispatch('spec-events');
            $this->dispatch('show-success-message', message: 'Spesifikasi berhasil dihapus!')->to('admin.product.edit');
        } catch (\Exception $e) {
            $this->errorMessage = 'Gagal menghapus spesifikasi. Silakan coba lagi.';
            return;
        }
    }

    public function render()
    {
        return view('livewire.admin.spec.delete');
    }
}
