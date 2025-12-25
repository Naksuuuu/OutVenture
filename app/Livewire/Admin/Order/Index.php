<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::with(['user', 'items'])
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('tgl_order', 'desc')
            ->paginate(15);

        return view('livewire.admin.order.index', [
            'orders' => $orders
        ])->layout('components.layouts.admin', ['title' => 'Orders']);
    }
}
