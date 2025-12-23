<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{

  public $totalProducts = 0;
  public $totalCategories = 0;
  public $totalTransaksi = 0;
  public $totalPendapatan = 0;



  // app/Livewire/Dashboard.php
  public $salesData = [4000, 3000, 2000, 2800, 1900, 2400];
  public $revenueData = [2500, 1500, 10000, 4000, 5000, 3800];

  #[Computed]
  public  $stats = [
    ['value' => '150', 'label' => 'Total Products', 'trend' => '+12% from last month', 'icon' => '📦'],
    ['value' => '5', 'label' => 'Categories', 'trend' => '+2 new this week', 'icon' => '📂'],
    ['value' => '10', 'label' => 'Total Transaction', 'trend' => '+8% from last month', 'icon' => '💰'],
    ['value' => '$150.22', 'label' => 'Monthly Revenue', 'trend' => '+23% from last year', 'icon' => '📈'],
  ];

  #[Computed]
  public $bestSellingProducts = [
    ['name' => 'Tenda', 'price' => 100, 'image' => 'https://via.placeholder.com/60x60'],
    ['name' => 'Tas', 'price' => 75, 'image' => 'https://via.placeholder.com/60x60'],
  ];

  public function render()
  {

    $this->totalProducts = Product::count();
    $this->totalCategories = \App\Models\Category::count();
    $this->totalTransaksi = Order::count();
    $this->totalPendapatan = Order::sum('total_harga');


    return view('livewire.admin.dashboard')
      ->layout('components.layouts.admin', ['title' => 'Dashboard']);
  }
}
