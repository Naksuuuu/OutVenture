<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    use WithPagination;

    #[Url(history: true, keep: true)]
    public $search = '';

    #[Url(history: true, keep: true)]
    public $sortBy = 'latest';

    #[Url(history: true, keep: true)]
    public $status = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function downloadAllInvoices()
    {
        $orders = Order::with([
            'user',
            'items.variantSpec.variant.product.brand',
            'items.variantSpec.variant.color',
            'items.variantSpec.size'
        ])
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status !== 'all', function ($query) {
                $value = $this->status === 'lunas' ? 1 : 0;
                $query->where('status_pembayaran', $value);
            })
            ->get();

        if ($orders->isEmpty()) {
            $this->dispatch('notify', type: 'error', message: 'Tidak ada pesanan untuk diunduh');
            return;
        }

        $zipFileName = 'invoices-' . now()->format('Y-m-d-His') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($orders as $order) {
                $pdf = Pdf::loadView('pdf.invoice', ['order' => $order]);
                $pdfContent = $pdf->output();
                $fileName = 'invoice-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf';
                $zip->addFromString($fileName, $pdfContent);
            }
            $zip->close();
        }

        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    public function render()
    {
        $orders = Order::with(['user', 'items'])
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status !== 'all', function ($query) {
                $value = $this->status === 'lunas' ? 1 : 0;
                $query->where('status_pembayaran', $value);
            })
            ->when($this->sortBy === 'latest', function ($query) {
                $query->orderBy('tgl_order', 'desc');
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->orderBy('tgl_order', 'asc');
            })
            ->paginate(15);

        return view('livewire.admin.order.index', [
            'orders' => $orders
        ])->layout('components.layouts.admin', ['title' => 'Orders']);
    }
}
