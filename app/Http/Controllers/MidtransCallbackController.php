<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
  public function callback(Request $request)
  {


    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');

    try {
      $notification = new Notification();

      $transactionStatus = $notification->transaction_status;
      $fraudStatus = $notification->fraud_status;
      $orderId = $notification->order_id;


      $orderIdParts = explode('-', $orderId);
      $realOrderId = $orderIdParts[1] ?? null;

      if (!$realOrderId) {
        return response()->json(['message' => 'Invalid order ID'], 400);
      }

      $order = Order::find($realOrderId);

      if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
      }

      // Handle payment status
      if ($transactionStatus == 'capture') {
        if ($fraudStatus == 'accept') {
          $order->update(['status_pembayaran' => 1]); // Paid
        }
      }

      return response()->json(['message' => 'Callback received successfully']);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    }
  }
}
