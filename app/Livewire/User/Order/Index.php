<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $statusFilter = 'all'; // Filter: all, pending, success, failed

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getOrdersProperty()
    {
        $query = Order::where('id_user', auth()->id())
            ->with([
                'user',
                'items.variantSpec.variant.product',
            ])
            ->orderBy('tgl_order', 'desc');

        if ($this->statusFilter !== 'all') {
            $query->where('status_pembayaran', $this->statusFilter);
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.user.order.index', [
            'orders' => $this->orders
        ])->layout('components.layouts.app', ['title' => 'My Orders']);
    }
}
