<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Dashboard extends Component
{

  public $totalProducts = 0;
  public $totalCategories = 0;
  public $totalTransaksi = 0;
  public $totalPendapatan = 0;
  public $bestSellingProducts;

  public $lowStockCount = 0;
  public $lowStockItems = [];
  public $latestOrder = null;


  public $salesLabels = [];
  public $salesData = [];
  public $revenueLabels = [];
  public $revenueData = [];



  /**
   * Merender tampilan dashboard admin dengan statistik dan grafik.
   */
  public function render()
  {
    $stats = Cache::remember('admin_dashboard_stats', 10, function () {
      return [
        'totalProducts' => Product::count(),
        'totalCategories' => Category::count(),
        'totalTransaksi' => Order::where('status_pembayaran', true)->count(),
        'totalPendapatan' => Order::where('status_pembayaran', true)->sum('total_harga'),
        'lowStockCount' => \App\Models\ProductVariantSpec::where('stok', '<=', 3)->count(),
        'lowStockItems' => \App\Models\ProductVariantSpec::with([
          'variant.product.brand',
          'variant.color',
          'size'
        ])
          ->where('stok', '<=', 3)
          ->orderBy('stok')
          ->take(5)
          ->get(),
        'bestSellingProducts' => ProductVariant::with(['product.brand', 'color'])
          ->withSum([
            'specs as total_terjual' => function ($query) {
              $query->join('order_items', 'product_variant_specs.id', '=', 'order_items.id_variant_spec')
                ->join('orders', 'orders.id', '=', 'order_items.id_order')
                ->where('orders.status_pembayaran', true);
            }
          ], 'order_items.quantity')
          ->orderByDesc('total_terjual')
          ->take(5)
          ->get(),
        'latestOrder' => Order::with('user')->latest('tgl_order')->first(),
        'charts' => $this->getMonthlyChartsData()
      ];
    });

    $this->totalProducts = $stats['totalProducts'];
    $this->totalCategories = $stats['totalCategories'];
    $this->totalTransaksi = $stats['totalTransaksi'];
    $this->totalPendapatan = $stats['totalPendapatan'];
    $this->bestSellingProducts = $stats['bestSellingProducts'];
    $this->lowStockCount = $stats['lowStockCount'];
    $this->lowStockItems = $stats['lowStockItems'];
    $this->latestOrder = $stats['latestOrder'];
    $this->salesLabels = $stats['charts']['labels'];
    $this->salesData = $stats['charts']['sales'];
    $this->revenueLabels = $stats['charts']['labels'];
    $this->revenueData = $stats['charts']['revenue'];


    return view('livewire.admin.dashboard')
      ->layout('components.layouts.admin', ['title' => 'Dashboard']);
  }

  /**
   * Mengambil data penjualan dan pendapatan bulanan untuk grafik.
   */
  private function getMonthlyChartsData(): array
  {
    $start = Carbon::now()->startOfMonth()->subMonths(5);
    $expr = $this->monthGroupExpression();

    $rows = Order::selectRaw("$expr as ym, COUNT(*) as orders_count, SUM(total_harga) as revenue")
      ->where('status_pembayaran', true)
      ->where('tgl_order', '>=', $start)
      ->groupBy('ym')
      ->orderBy('ym')
      ->get();

    $labels = [];
    $sales = [];
    $revenues = [];
    $map = [];
    foreach ($rows as $r) {
      $map[$r->ym] = ['units' => (int) $r->orders_count, 'revenue' => (float) $r->revenue];
    }

    for ($i = 5; $i >= 0; $i--) {
      $month = Carbon::now()->subMonths($i)->startOfMonth();
      $key = $month->format('Y-m');
      $labels[] = $month->format('M');
      $sales[] = isset($map[$key]) ? (int) $map[$key]['units'] : 0;
      $revenues[] = isset($map[$key]) ? (float) $map[$key]['revenue'] : 0.0;
    }

    return [
      'labels' => $labels,
      'sales' => $sales,
      'revenue' => $revenues,
    ];
  }

  /**
   * Mendapatkan ekspresi SQL untuk grouping per bulan berdasarkan driver database.
   */
  private function monthGroupExpression(): string
  {
    $driver = OrderItem::query()->getModel()->getConnection()->getDriverName();
    switch ($driver) {
      case 'sqlite':
        return "strftime('%Y-%m', tgl_order)";
      case 'pgsql':
        return "to_char(tgl_order, 'YYYY-MM')";
      case 'sqlsrv':
        return "FORMAT(tgl_order, 'yyyy-MM')";
      default:
        return "DATE_FORMAT(tgl_order, '%Y-%m')";
    }
  }
}
