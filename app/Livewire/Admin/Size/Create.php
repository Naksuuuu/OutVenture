<?php

namespace App\Livewire\Admin\Size;

use Livewire\Component;
use App\Models\SizeGroup;
use App\Models\SizeValue;

class Create extends Component
{
  public $nama_group = '';
  public $sizeValues = [];

  protected $rules = [
    'nama_group' => 'required|string|max:255',
    'sizeValues.*.label_size' => 'required|string|max:50',
    'sizeValues.*.sort_order' => 'nullable|integer',
  ];

  /**
   * Menyiapkan data awal dengan satu nilai ukuran kosong.
   */
  public function mount()
  {
    $this->sizeValues = [
      ['label_size' => '', 'sort_order' => 1]
    ];
  }

  /**
   * Menambahkan form input untuk nilai ukuran baru.
   */
  public function addSizeValue()
  {
    $this->sizeValues[] = [
      'label_size' => '',
      'sort_order' => count($this->sizeValues) + 1
    ];
  }

  /**
   * Menghapus nilai ukuran dari daftar input.
   */
  public function removeSizeValue($index)
  {
    unset($this->sizeValues[$index]);
    $this->sizeValues = array_values($this->sizeValues);

    foreach ($this->sizeValues as $key => $value) {
      $this->sizeValues[$key]['sort_order'] = $key + 1;
    }
  }

  /**
   * Menyimpan grup ukuran beserta nilai-nilainya ke database.
   */
  public function save()
  {
    $this->validate();

    $sizeGroup = SizeGroup::create([
      'nama_group' => $this->nama_group,
    ]);

    foreach ($this->sizeValues as $sizeValue) {
      if (!empty($sizeValue['label_size'])) {
        SizeValue::create([
          'id_size_group' => $sizeGroup->id,
          'label_size' => $sizeValue['label_size'],
          'sort_order' => $sizeValue['sort_order'],
        ]);
      }
    }

    return redirect()->route('admin.sizes.index')->with('notifySuccess', 'Size Grup Berhasil di Tambahkan!');
  }

  /**
   * Merender tampilan halaman pembuatan grup ukuran.
   */
  public function render()
  {
    return view('livewire.admin.size.create')
      ->layout('components.layouts.admin', ['title' => 'Create Size Group']);
  }
}
