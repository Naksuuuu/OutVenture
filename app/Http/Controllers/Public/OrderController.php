<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $orders = Order::with(['items', 'user'])
      ->where('id_user', Auth::id())
      ->orderBy('tgl_order', 'desc')->get()
      ->paginate(10);

    if ($orders->isEmpty()) {
      return view('public.orders.index', ['orders' => []]);
    }

    return view('public.orders.index', ['orders' => $orders]);
  }

  public function show(Order $order)
  {
    if ($order->id_user !== Auth::id()) {
      abort(403, 'Unauthorized action.');
    }

    $order->load(['items', 'user']);

    return view('public.orders.show', ['order' => $order]);
  }

  public function store(Request $request)
  {
    // Implementation for storing a new order
  }
}
