<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
  public Order $order;

  public function mount($id)
  {
    $this->order = Order::with(['user', 'items.variantSpec.variant.product', 'items.variantSpec.variant.color', 'items.variantSpec.size'])
      ->findOrFail($id);
  }

  public function render()
  {
    return view('livewire.admin.order.show')->layout('components.layouts.admin', ['title' => 'Order Details']);
  }
}
