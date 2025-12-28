<?php

namespace App\Livewire\Admin\Size;

use Livewire\Component;
use App\Models\SizeGroup;
use App\Models\SizeValue;

class Edit extends Component
{
  public $sizeGroup;
  public $nama_group;
  public $sizeValues = [];
  public $deletedValues = [];

  protected $rules = [
    'nama_group' => 'required|string|max:255',
    'sizeValues.*.label_size' => 'required|string|max:50',
    'sizeValues.*.sort_order' => 'nullable|integer',
  ];

  public function mount($sizeGroupId)
  {
    $this->sizeGroup = SizeGroup::with('values')->findOrFail($sizeGroupId);
    $this->nama_group = $this->sizeGroup->nama_group;

    $this->sizeValues = $this->sizeGroup->values->map(function ($value) {
      return [
        'id' => $value->id,
        'label_size' => $value->label_size,
        'sort_order' => $value->sort_order,
      ];
    })->toArray();

    if (empty($this->sizeValues)) {
      $this->sizeValues = [
        ['label_size' => '', 'sort_order' => 1]
      ];
    }
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
    if (isset($this->sizeValues[$index]['id'])) {
      $this->deletedValues[] = $this->sizeValues[$index]['id'];
    }

    unset($this->sizeValues[$index]);
    $this->sizeValues = array_values($this->sizeValues);

    foreach ($this->sizeValues as $key => $value) {
      $this->sizeValues[$key]['sort_order'] = $key + 1;
    }
  }

  public function update()
  {
    $this->validate();

    $this->sizeGroup->update([
      'nama_group' => $this->nama_group,
    ]);

    if (!empty($this->deletedValues)) {
      SizeValue::whereIn('id', $this->deletedValues)->delete();
    }

    foreach ($this->sizeValues as $sizeValue) {
      if (!empty($sizeValue['label_size'])) {
        if (isset($sizeValue['id'])) {
          SizeValue::where('id', $sizeValue['id'])->update([
            'label_size' => $sizeValue['label_size'],
            'sort_order' => $sizeValue['sort_order'],
          ]);
        } else {
          SizeValue::create([
            'id_size_group' => $this->sizeGroup->id,
            'label_size' => $sizeValue['label_size'],
            'sort_order' => $sizeValue['sort_order'],
          ]);
        }
      }
    }

    return redirect()->route('admin.sizes.index')->with('notifySuccess', 'Size Group updated successfully!');
  }

  public function render()
  {
    return view('livewire.admin.size.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Size Group']);
  }
}
