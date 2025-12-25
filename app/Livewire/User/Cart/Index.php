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
            'cartitems.variantSpec.variant.product',
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

    public function render()
    {
        // \dd($this->cartItems);
        return view('livewire.user.cart.index');
    }
}
