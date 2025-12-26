<?php

namespace App\Livewire\Public\Template;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $search = '';
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cart-updated')]
    public function updateCartCount()
    {
        if (Auth::check()) {
            $cart = Cart::where('id_user', Auth::id())->with('cartitems')->first();
            $this->cartCount = $cart ? $cart->cartitems->sum('quantity') : 0;
        } else {
            $this->cartCount = 0;
        }
    }

    #[Computed]
    public function products()
    {
        if (empty($this->search)) {
            return [];
        }

        return Product::with(['brand', 'variants' => function ($query) {
                $query->whereNotNull('image')->limit(1);
            }])
            ->where('nama_product', 'like', '%' . $this->search . '%')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.public.template.navbar');
    }
}
