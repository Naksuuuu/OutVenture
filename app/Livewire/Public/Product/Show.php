<?php

namespace App\Livewire\Public\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
  public $product;
  public $selectedVariantId;
  public $selectedSize;
  public $availableSizes = [];

  public function mount($id)
  {
    $this->product = Product::with([
      'category.sizeGroup.values',
      'brand',
      'variants.color',
      'variants.specs.size'
    ])->findOrFail($id);

    // Set default variant (first one)
    if ($this->product->variants->isNotEmpty()) {
      $this->selectedVariantId = $this->product->variants->first()->id;
      $this->loadAvailableSizes();
    }
  }

  public function selectVariant($variantId)
  {
    $this->selectedVariantId = $variantId;
    $this->selectedSize = null;
    $this->loadAvailableSizes();
  }

  public function selectSize($sizeId)
  {
    $this->selectedSize = $sizeId;
  }

  public function loadAvailableSizes()
  {
    // Load all sizes from category's size group
    if ($this->product->category && $this->product->category->sizeGroup) {
      $this->availableSizes = $this->product->category->sizeGroup->values->sortBy('sort_order');
    }
  }

  public function getSelectedVariantProperty()
  {
    return $this->product->variants->find($this->selectedVariantId);
  }

  public function getSelectedSpecProperty()
  {
    if (!$this->selectedSize || !$this->selectedVariantId) {
      return null;
    }

    $variant = $this->product->variants->find($this->selectedVariantId);
    return $variant?->specs->firstWhere('id_size_value', $this->selectedSize);
  }

  public function addToCart()
  {
    if (!Auth::check()) {
      return redirect()->route('auth.login');
    }

    if (!$this->selectedSize) {
      $this->dispatch('notify', type: 'error', message: 'Silakan pilih ukuran terlebih dahulu');
      return;
    }

    $spec = $this->selectedSpec;
    
    if (!$spec || $spec->stok <= 0) {
      $this->dispatch('notify', type: 'error', message: 'Produk tidak tersedia');
      return;
    }

    // Get or create cart
    $cart = Cart::firstOrCreate([
      'id_user' => Auth::id()
    ]);

    // Check if item already exists in cart
    $cartItem = CartItem::where('id_cart', $cart->id)
      ->where('id_variant_spec', $spec->id)
      ->first();

    if ($cartItem) {
      // Update quantity if item exists
      if ($cartItem->quantity + 1 > $spec->stok) {
        $this->dispatch('notify', type: 'error', message: 'Stok tidak mencukupi');
        return;
      }
      $cartItem->increment('quantity');
    } else {
      // Create new cart item
      CartItem::create([
        'id_cart' => $cart->id,
        'id_variant_spec' => $spec->id,
        'quantity' => 1
      ]);
    }

    $this->dispatch('notify', type: 'success', message: 'Produk berhasil ditambahkan ke keranjang');
    $this->dispatch('cart-updated');
  }

  public function render()
  {
    return view('livewire.public.product.show')
      ->layout('components.layouts.app', ['title' => $this->product->nama_product]);
  }
}
