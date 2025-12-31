<?php

namespace App\Livewire\Admin\Variant;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantSpec;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $errorMessage = '';

    public $product;

    protected $listeners = [
        'variant-created' => 'refreshProduct',
        'variant-updated' => 'refreshProduct',
        'variant-deleted' => 'refreshProduct',
        'spec-events' => 'refreshProduct',
        'delete-success' => 'handleDeleteSuccess',
    ];

    public function deleteVariant($id)
    {
        $variant = ProductVariant::with(['specs'])->findOrFail($id);


        if ($variant->specs->count() > 0) {
            $this->errorMessage = 'Varian tidak dapat dihapus karena memiliki spesifikasi';
            return;
        }

        if ($variant) {
            // Hapus gambar jika ada
            if ($variant->image) {
                Storage::disk('public')->delete($variant->image);
            }

            $variant->delete();
            $this->dispatch('delete-success');
            $this->dispatch('variant-deleted');
            $this->dispatch('notify', type: 'success', message: 'Varian berhasil dihapus!');
        } else {
            $this->dispatch('delete-error', message: 'Varian tidak ditemukan.');
        }
    }

    public function deleteSpec($id)
    {
        $spec = ProductVariantSpec::find($id);

        if ($spec) {
            $spec->delete();
            $this->dispatch('delete-success');
            $this->dispatch('spec-events');
            $this->dispatch('notify', type: 'success', message: 'Spesifikasi berhasil dihapus!');
        } else {
            $this->dispatch('delete-error', message: 'Spesifikasi tidak ditemukan.');
        }
    }

    public function handleDeleteSuccess()
    {
        $this->refreshProduct();
    }

    public function mount(Product $product)
    {
        $this->product = $product->load(['variants.color', 'variants.specs']);
    }

    public function refreshProduct()
    {
        $this->product = Product::with(['variants.color', 'variants.specs'])
            ->findOrFail($this->product->id);
    }

    public function render()
    {
        return view('livewire.admin.variant.index');
    }
}

