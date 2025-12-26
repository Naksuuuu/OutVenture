<?php

namespace App\Livewire\User\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $cartItems;
    public $subtotal = 0;
    public $total = 0;


    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $cart = Cart::where('id_user', Auth::id())->with([
            'cartitems.variantSpec.variant.product.brand',
            'cartitems.variantSpec.variant.color',
            'cartitems.variantSpec.size'
        ])->first();

        $this->cartItems = $cart ? $cart->cartitems : collect();
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->variantSpec->harga;
        });

        $this->total = $this->subtotal;
    }

    public function incrementQuantity($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item && $item->quantity < $item->variantSpec->stok) {
            $item->increment('quantity');
            $this->loadCart();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Jumlah produk berhasil ditambah');
        } else {
            session()->flash('error', 'Stok tidak mencukupi');
        }
    }

    public function decrementQuantity($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            $this->loadCart();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Jumlah produk berhasil dikurangi');
        }
    }

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item) {
            $item->delete();
            $this->loadCart();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Produk berhasil dihapus dari keranjang');
        }
    }

    public function checkout()
    {
        if ($this->cartItems->isEmpty()) {
            session()->flash('error', 'Keranjang Anda kosong');
            return;
        }

        // TODO: Implement checkout logic
        // For now, redirect to checkout page
        return redirect()->route('user.checkout');
    }

    public function render()
    {
        return view('livewire.user.cart.index')->layout('components.layouts.app', ['title' => 'My Cart']);
    }
}
