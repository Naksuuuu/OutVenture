<?php

namespace App\Livewire\Admin\Size;

use Livewire\Component;
use App\Models\SizeGroup;
use App\Models\SizeValue;
use Illuminate\Database\Eloquent\Collection;

class Edit extends Component
{
  public $sizeGroup;
  public $nama_group;
  public array $sizeValues = []; // Use array for form stability
  public $deletedValues = [];

  protected $rules = [
    'nama_group' => 'required|string|max:255',
    'sizeValues.*.label_size' => 'required|string|max:50',
    'sizeValues.*.sort_order' => 'nullable|integer',
  ];

  /**
   * Menyiapkan data grup ukuran yang akan diedit.
   */
  public function mount($sizeGroupId)
  {
    $this->sizeGroup = SizeGroup::with([
      'values' => function ($query) {
        $query->orderBy('sort_order');
      }
    ])->findOrFail($sizeGroupId);

    $this->nama_group = $this->sizeGroup->nama_group;
    // Convert to array to avoid Livewire serialization issues with mixed model states
    $this->sizeValues = $this->sizeGroup->values->toArray();

    if (empty($this->sizeValues)) {
      $this->addSizeValue();
    }
  }

  public $errorMessage = '';

  /**
   * Menambahkan form input untuk nilai ukuran baru.
   */
  public function addSizeValue()
  {
    $this->sizeValues[] = [
      'label_size' => '',
      'sort_order' => count($this->sizeValues) + 1,
      // 'id' is undefined for new items
    ];
  }

  /**
   * Menandai nilai ukuran untuk dihapus atau menghapusnya dari daftar input jika belum disimpan.
   */
  public function deleteValue($index)
  {
    $this->errorMessage = '';

    if (!isset($this->sizeValues[$index])) {
      return;
    }

    // Check availability of ID
    if (isset($this->sizeValues[$index]['id'])) {
      $sizeValueId = $this->sizeValues[$index]['id'];
      $sizeValue = SizeValue::find($sizeValueId);

      if ($sizeValue && $sizeValue->specs()->exists()) {
        $this->errorMessage = 'Nilai ukuran ini sedang digunakan pada varian produk dan tidak dapat dihapus.';
        return;
      }

      $this->deletedValues[] = $sizeValueId;
    }

    unset($this->sizeValues[$index]);
    $this->sizeValues = array_values($this->sizeValues); // Re-index array

    // Update sort orders
    foreach ($this->sizeValues as $key => $value) {
      $this->sizeValues[$key]['sort_order'] = $key + 1;
    }

    $this->dispatch('delete-success');
    $this->dispatch('notify', type: 'success', message: 'Nilai ukuran berhasil dihapus dari daftar (Simpan untuk memproses).');
  }

  /**
   * Memperbarui grup ukuran dan nilai-nilainya ke database.
   */
  public function update()
  {
    $this->validate();

    $this->sizeGroup->update([
      'nama_group' => $this->nama_group,
    ]);

    if (!empty($this->deletedValues)) {
      SizeValue::whereIn('id', $this->deletedValues)->delete();
    }

    foreach ($this->sizeValues as $item) {
      if (!empty($item['label_size'])) {
        if (isset($item['id'])) {
          // Update existing
          SizeValue::where('id', $item['id'])->update([
            'label_size' => $item['label_size'],
            'sort_order' => $item['sort_order'],
          ]);
        } else {
          // Create new
          SizeValue::create([
            'id_size_group' => $this->sizeGroup->id,
            'label_size' => $item['label_size'],
            'sort_order' => $item['sort_order'],
          ]);
        }
      }
    }

    $this->deletedValues = [];

    // Refresh and convert back to array
    $this->sizeValues = $this->sizeGroup->values()->orderBy('sort_order')->get()->toArray();

    $this->dispatch('notify', type: 'success', message: 'Size Group Berhasil Diupdate');
  }

  /**
   * Merender tampilan halaman edit grup ukuran.
   */
  public function render()
  {
    return view('livewire.admin.size.edit')
      ->layout('components.layouts.admin', ['title' => 'Edit Size Group']);
  }
}
