<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;
use App\Models\Color;

class Create extends Component
{
    public $nama_warna = '';
    public $hex_code = '';
    public $existingColorName = null;
    public $existingColorHex = null;

    protected $rules = [
        'nama_warna' => 'required|string|max:50|unique:colors,nama_warna',
        'hex_code' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,hex_code',
    ];

    protected $messages = [
        'nama_warna.required' => 'Nama warna wajib diisi.',
        'nama_warna.max' => 'Nama warna maksimal 50 karakter.',
        'nama_warna.unique' => 'Warna dengan nama ini sudah ada!',
        'hex_code.required' => 'Kode hex wajib diisi.',
        'hex_code.regex' => 'Format kode hex tidak valid (contoh: #FF0000).',
        'hex_code.unique' => 'Warna dengan kode hex ini sudah ada!',
    ];

    /**
     * Memperbarui kode hex secara otomatis jika nama warna yang dimasukkan dikenali.
     */
    public function updatedNamaWarna($value)
    {
        $this->existingColorName = Color::where('nama_warna', $value)->first();

        if (!$this->existingColorName) {
            $this->resetErrorBag('nama_warna');
        }

        $colorMap = [
            'merah' => '#DC2626',
            'biru' => '#2563EB',
            'hijau' => '#16A34A',
            'kuning' => '#EAB308',
            'orange' => '#F97316',
            'ungu' => '#9333EA',
            'pink' => '#EC4899',
            'coklat' => '#92400E',
            'hitam' => '#000000',
            'putih' => '#FFFFFF',
            'abu-abu' => '#6B7280',
            'abu' => '#6B7280',
            'silver' => '#C0C0C0',
            'gold' => '#FFD700',
            'navy' => '#000080',
            'maroon' => '#800000',
            'tosca' => '#40E0D0',
            'cream' => '#FFFDD0',
        ];

        $key = strtolower(trim($value));
        if (isset($colorMap[$key])) {
            $this->hex_code = $colorMap[$key];
        }
    }

    /**
     * Memvalidasi kode hex secara real-time saat mengetik.
     */
    public function updatedHexCode($value)
    {
        $this->existingColorHex = Color::where('hex_code', $value)->first();

        if (!$this->existingColorHex) {
            $this->resetErrorBag('hex_code');
        }
    }

    /**
     * Menyimpan warna baru ke database.
     */
    public function save()
    {
        $this->validate();

        Color::create([
            'nama_warna' => $this->nama_warna,
            'hex_code' => $this->hex_code,
        ]);

        return redirect()->route('admin.colors.index')->with('notifySuccess', 'Warna berhasil ditambahkan!');
    }

    /**
     * Merender tampilan halaman tambah warna.
     */
    public function render()
    {
        return view('livewire.admin.color.create')->layout('components.layouts.admin', ['title' => 'Tambah Warna']);
    }
}
