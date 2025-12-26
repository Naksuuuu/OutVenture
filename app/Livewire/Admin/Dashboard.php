<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{

  public $totalProducts = 0;
  public $totalCategories = 0;
  public $totalTransaksi = 0;
  public $totalPendapatan = 0;
  public $bestSellingProducts;




  public $salesData = [4000, 3000, 2000, 2800, 1900, 2400];
  public $revenueData = [2500, 1500, 10000, 4000, 5000, 3800];



  public function render()
  {
    $stats = Cache::remember('admin_dashboard_stats', 10, function () {
      return [
        'totalProducts' => Product::count(),
        'totalCategories' => Category::count(),
        'totalTransaksi' => Order::count(),
        'totalPendapatan' => Order::sum('total_harga'),
        'bestSellingProducts' => ProductVariant::with(['product.brand', 'color'])
          ->withSum(['specs as total_terjual' => function ($query) {
            $query->join('order_items', 'product_variant_specs.id', '=', 'order_items.id_variant_spec');
          }], 'order_items.quantity') 
          ->orderByDesc('total_terjual')
          ->take(5)
          ->get()
      ];
    });

    $this->totalProducts = $stats['totalProducts'];
    $this->totalCategories = $stats['totalCategories'];
    $this->totalTransaksi = $stats['totalTransaksi'];
    $this->totalPendapatan = $stats['totalPendapatan'];
    $this->bestSellingProducts = $stats['bestSellingProducts'];


    return view('livewire.admin.dashboard')
      ->layout('components.layouts.admin', ['title' => 'Dashboard']);
  }
}
