<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;
use App\Models\Color;

class Edit extends Component
{
    public $color;
    public $nama_warna;
    public $hex_code;
    public $isUsedInVariants = false;
    public $variantsCount = 0;

    protected function rules()
    {
        return [
            'nama_warna' => 'required|string|max:50|unique:colors,nama_warna,' . $this->color->id,
            'hex_code' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,hex_code,' . $this->color->id,
        ];
    }

    public function mount($colorId)
    {
        $this->color = Color::withCount('productVariants')->findOrFail($colorId);
        $this->nama_warna = $this->color->nama_warna;
        $this->hex_code = $this->color->hex_code;

        $this->variantsCount = $this->color->product_variants_count;
        $this->isUsedInVariants = $this->variantsCount > 0;
    }

    public function update()
    {
        if ($this->isUsedInVariants) {
            $this->addError('used_in_variants', 'Warna ini tidak dapat diubah karena sedang digunakan pada ' . $this->variantsCount . ' varian produk!');
            return;
        }

        $this->validate();

        $this->color->update([
            'nama_warna' => $this->nama_warna,
            'hex_code' => $this->hex_code,
        ]);

        session()->flash('success', 'Warna berhasil diperbarui!');

        return redirect()->route('admin.colors.index');
    }

    public function render()
    {
        return view('livewire.admin.color.edit')->layout('components.layouts.admin', ['title' => 'Edit Color']);
    }
}
