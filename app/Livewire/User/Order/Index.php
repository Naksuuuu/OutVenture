<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\MidtransService;

class Index extends Component
{
    use WithPagination;

    public $statusFilter = 'all'; // Filter: all, unpaid (0), paid (1)

    /**
     * Mereset halaman pagination saat filter status berubah.
     */
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    /**
     * Mengambil daftar pesanan pengguna dengan filter status dan pagination.
     */
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

    /**
     * Mengunduh invoice pesanan dalam format PDF.
     */
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
            $this->dispatch('notify', type: 'error', message: 'Invoice hanya tersedia untuk pesanan yang sudah lunas');
            return;
        }

        $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'invoice-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    /**
     * Memproses pembayaran pesanan menggunakan Midtrans.
     */
    public function payNow($orderId)
    {
        try {

            $order = Order::with([
                'user',
                'items.variantSpec.variant.product.brand',
                'items.variantSpec.variant.color',
                'items.variantSpec.size'
            ])->findOrFail($orderId);


            if ($order->id_user !== auth()->id()) {
                $this->dispatch('notify', type: 'error', message: 'Unauthorized access');
                return;
            }

            if ($order->status_pembayaran != 0) {
                $this->dispatch('notify', type: 'error', message: 'Pesanan ini sudah dibayar');
                return;
            }

            $midtrans = new MidtransService();
            $snapToken = $midtrans->createTransaction($order);

            $order->update(['snap_token' => $snapToken]);

            $this->dispatch('open-payment', snapToken: $snapToken);
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Merender tampilan halaman daftar pesanan pengguna.
     */
    public function render()
    {
        return view('livewire.user.order.index', [
            'orders' => $this->orders
        ])->layout('components.layouts.app', ['title' => 'My Orders']);
    }
}
