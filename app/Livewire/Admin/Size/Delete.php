<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;

class Delete extends Component
{
  public $sizeGroup;
  public $errorMessage = '';
  
  protected $listeners = [
    'size-values-updated' => 'refreshGroup',
  ];

  public function mount($sizeGroup)
  {
    $this->sizeGroup = SizeGroup::findOrFail($sizeGroup);
  }

  public function delete()
  {
    $this->errorMessage = '';

    
    $this->sizeGroup->refresh();
    
    if ($this->sizeGroup->values()->exists()) {
      $this->errorMessage = 'Size group masih memiliki size values. Hapus semua value terlebih dahulu.';
      return;
    }

    try {
      $this->sizeGroup->delete();
    } catch (\Exception $e) {
      $this->errorMessage = 'Gagal menghapus size group. Coba lagi.';
      return;
    }

    return redirect()->route('admin.sizes.index')->with('notifySuccess', 'Size Group deleted successfully!');
  }
  
  public function refreshGroup()
  {
    $this->sizeGroup = SizeGroup::findOrFail($this->sizeGroup->id);
    $this->errorMessage = '';
  }

  public function render()
  {
    return view('livewire.admin.size.delete');
  }
}
