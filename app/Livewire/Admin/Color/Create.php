<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;
use App\Models\Color;

class Create extends Component
{
    public $nama_warna = '';

    protected $rules = [
        'nama_warna' => 'required|string|max:50|unique:colors,nama_warna',
    ];

    public function save()
    {
        $this->validate();

        Color::create([
            'nama_warna' => $this->nama_warna,
        ]);

        session()->flash('success', 'Warna berhasil ditambahkan!');

        return redirect()->route('admin.colors.index');
    }

    public function render()
    {
        return view('livewire.admin.color.create')->layout('components.layouts.admin', ['title' => 'Tambah Warna']);
    }
}
