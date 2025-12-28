<?php

namespace App\Livewire\User\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $this->dispatch('notify', type: 'success', message: 'Jumlah produk berhasil ditambah');
        } else {
            $this->dispatch('notify', type: 'error', message: 'Stok tidak mencukupi');
        }
    }

    public function decrementQuantity($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            $this->loadCart();
            $this->dispatch('cart-updated');
            $this->dispatch('notify', type: 'success', message: 'Jumlah produk berhasil dikurangi');
        }
    }

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item) {
            $item->delete();
            $this->loadCart();
            $this->dispatch('cart-updated');
            $this->dispatch('notify', type: 'success', message: 'Produk berhasil dihapus dari keranjang');
        }
    }

    public function checkout()
    {
        if ($this->cartItems->isEmpty()) {
            $this->dispatch('notify', type: 'error', message: 'Keranjang Anda kosong');
            return;
        }

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'id_user' => Auth::id(),
                'tgl_order' => now(),
                'total_harga' => $this->total,
                'status_pembayaran' => 0
            ]);

            // Create order items from cart items
            foreach ($this->cartItems as $cartItem) {
                // Check stock availability
                if ($cartItem->variantSpec->stok < $cartItem->quantity) {
                    throw new \Exception('Stok produk ' . $cartItem->variantSpec->variant->product->nama_product . ' tidak mencukupi');
                }

                // Create order item
                OrderItem::create([
                    'id_order' => $order->id,
                    'id_variant_spec' => $cartItem->id_variant_spec,
                    'tgl_order' => now(),
                    'quantity' => $cartItem->quantity,
                    'harga' => $cartItem->variantSpec->harga
                ]);

                // Reduce stock
                $cartItem->variantSpec->decrement('stok', $cartItem->quantity);
            }

            // Clear cart
            $cart = Cart::where('id_user', Auth::id())->first();
            if ($cart) {
                $cart->cartitems()->delete();
            }

            DB::commit();

            $this->dispatch('cart-updated');

            return redirect()->route('user.orders.index')->with('notifySuccess', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
        } catch (\Exception $e) {
            dd('blog');
            DB::rollBack();
            $this->dispatch('notify', type: 'error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.cart.index')->layout('components.layouts.app', ['title' => 'My Cart']);
    }
}
