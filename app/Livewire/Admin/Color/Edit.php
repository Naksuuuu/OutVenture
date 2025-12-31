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

    /**
     * Mendefinisikan aturan validasi.
     */
    protected function rules()
    {
        return [
            'nama_warna' => 'required|string|max:50|unique:colors,nama_warna,' . $this->color->id,
            'hex_code' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,hex_code,' . $this->color->id,
        ];
    }

    protected $messages = [
        'nama_warna.required' => 'Nama warna wajib diisi.',
        'nama_warna.max' => 'Nama warna maksimal 50 karakter.',
        'nama_warna.unique' => 'Warna dengan nama ini sudah ada!',
        'hex_code.required' => 'Kode hex wajib diisi.',
        'hex_code.regex' => 'Format kode hex tidak valid (contoh: #FF0000).',
        'hex_code.unique' => 'Warna dengan kode hex ini sudah ada!',
    ];

    /**
     * Menyiapkan data awal warna yang akan diedit.
     */
    public function mount(Color $color)
    {
        $this->color = $color->loadCount('productVariants');
        $this->nama_warna = $this->color->nama_warna;
        $this->hex_code = $this->color->hex_code;

        $this->variantsCount = $this->color->product_variants_count;
        $this->isUsedInVariants = $this->variantsCount > 0;
    }

    /**
     * Memperbarui data warna ke database.
     */
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

        return redirect()->route('admin.colors.index')->with('notifySuccess', 'Warna berhasil diperbarui!');
    }

    /**
     * Merender tampilan halaman edit warna.
     */
    public function render()
    {
        return view('livewire.admin.color.edit')->layout('components.layouts.admin', ['title' => 'Edit Color']);
    }
}
