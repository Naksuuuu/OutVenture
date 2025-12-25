<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;

class Delete extends Component
{
  public $sizeGroup;

  public function mount($sizeGroup)
  {
    $this->sizeGroup = SizeGroup::findOrFail($sizeGroup);
  }

  public function delete()
  {
    // Delete related size values first
    $this->sizeGroup->values()->delete();

    // Then delete the size group
    $this->sizeGroup->delete();

    session()->flash('success', 'Size Group deleted successfully!');

    return redirect()->route('admin.sizes.index');
  }

  public function render()
  {
    return view('livewire.admin.size.delete');
  }
}
