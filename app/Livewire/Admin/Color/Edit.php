<?php

namespace App\Livewire\Admin\Color;

use Livewire\Component;
use App\Models\Color;

class Edit extends Component
{
    public $color;
    public $nama_warna;

    protected $rules = [
        'nama_warna' => 'required|string|max:50',
    ];

    public function mount($colorId)
    {
        $this->color = Color::findOrFail($colorId);
        $this->nama_warna = $this->color->nama_warna;
    }

    public function update()
    {
        $this->validate();

        $this->color->update([
            'nama_warna' => $this->nama_warna,
        ]);

        session()->flash('success', 'Warna berhasil diupdate!');

        return redirect()->route('admin.colors.index');
    }

    public function render()
    {
        return view('livewire.admin.color.edit')->layout('components.layouts.admin', ['title' => 'Edit Color']);
    }
}
