<?php

namespace App\Livewire\Admin\Size;

use App\Models\SizeGroup;
use Livewire\Component;

class Show extends Component
{
  public $sizeGroup;

  public function mount($sizeGroupId)
  {
    $this->sizeGroup = SizeGroup::with(['values' => function ($query) {
      $query->orderBy('sort_order');
    }, 'categories'])->findOrFail($sizeGroupId);
  }

  public function render()
  {
    return view('livewire.admin.size.show')
      ->layout('components.layouts.admin', ['title' => 'Size Group Details']);
  }
}
