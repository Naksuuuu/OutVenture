<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination;

    public $statusFilter = 'all'; // Filter: all, unpaid (0), paid (1)

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getOrdersProperty()
    {
        $query = Order::where('id_user', auth()->id())
            ->with([
                'user',
                'items.variantSpec.variant.product.brand',
                'items.variantSpec.variant.color',
                'items.variantSpec.size'
            ])
            ->orderBy('tgl_order', 'desc');

        if ($this->statusFilter === 'unpaid') {
            $query->where('status_pembayaran', 0);
        } elseif ($this->statusFilter === 'paid') {
            $query->where('status_pembayaran', 1);
        }

        return $query->paginate(10);
    }

    public function downloadInvoice($orderId)
    {
        $order = Order::with([
            'user',
            'items.variantSpec.variant.product.brand',
            'items.variantSpec.variant.color',
            'items.variantSpec.size'
        ])->findOrFail($orderId);

        // Check if order belongs to current user
        if ($order->id_user !== auth()->id()) {
            abort(403);
        }

        // Check if order is paid
        if ($order->status_pembayaran != 1) {
            session()->flash('error', 'Invoice hanya tersedia untuk pesanan yang sudah lunas');
            return;
        }

        $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'invoice-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function render()
    {
        return view('livewire.user.order.index', [
            'orders' => $this->orders
        ])->layout('components.layouts.app', ['title' => 'My Orders']);
    }
}
