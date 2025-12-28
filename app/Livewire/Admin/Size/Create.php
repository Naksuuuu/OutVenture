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

  public function mount()
  {
    $this->sizeValues = [
      ['label_size' => '', 'sort_order' => 1]
    ];
  }

  public function addSizeValue()
  {
    $this->sizeValues[] = [
      'label_size' => '',
      'sort_order' => count($this->sizeValues) + 1
    ];
  }

  public function removeSizeValue($index)
  {
    unset($this->sizeValues[$index]);
    $this->sizeValues = array_values($this->sizeValues);

    foreach ($this->sizeValues as $key => $value) {
      $this->sizeValues[$key]['sort_order'] = $key + 1;
    }
  }

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

  public function render()
  {
    return view('livewire.admin.size.create')
      ->layout('components.layouts.admin', ['title' => 'Create Size Group']);
  }
}
