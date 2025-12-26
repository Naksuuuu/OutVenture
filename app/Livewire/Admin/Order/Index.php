<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

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
