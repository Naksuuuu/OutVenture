<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class Show extends Component
{
  public Order $order;

  public function mount($id)
  {
    $this->order = Order::with([
      'user',
      'items.variantSpec.variant.product.brand',
      'items.variantSpec.variant.color',
      'items.variantSpec.size'
    ])->findOrFail($id);

    // Check if order belongs to current user
    if ($this->order->id_user !== auth()->id()) {
      abort(403, 'Unauthorized access to order');
    }
  }

  public function downloadInvoice()
  {
    // Check if order is paid
    if ($this->order->status_pembayaran != 1) {
      $this->dispatch('notify', type: 'error', message: 'Invoice hanya tersedia untuk pesanan yang sudah lunas');
      return;
    }

    $pdf = Pdf::loadView('pdf.invoice', ['order' => $this->order]);

    return response()->streamDownload(function () use ($pdf) {
      echo $pdf->output();
    }, 'invoice-' . str_pad($this->order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
  }

  public function render()
  {
    return view('livewire.user.order.show')->layout('components.layouts.app', ['title' => 'Order Details']);
  }
}
