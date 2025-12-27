<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
  public function __construct()
  {
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;
  }

  public function createTransaction($order)
  {
    $items = [];
    foreach ($order->items as $item) {
      $items[] = [
        'id' => $item->id,
        'price' => (int) $item->harga,
        'quantity' => $item->quantity,
        'name' => $item->variantSpec->variant->product->nama_product . ' - ' . $item->variantSpec->variant->color->nama_warna . ' - ' . $item->variantSpec->size->label_size,
      ];
    }

    $params = [
      'transaction_details' => [
        'order_id' => 'ORDER-' . $order->id . '-' . time(),
        'gross_amount' => (int) $order->total_harga,
      ],
      'item_details' => $items,
      'customer_details' => [
        'first_name' => $order->user->name,
        'email' => $order->user->email,
      ],
      'enabled_payments' => [
        'credit_card',
        'gopay',
        'shopeepay',
        'bca_va',
        'bni_va',
        'bri_va',
        'permata_va',
        'other_va',
        'qris'
      ],
    ];

    try {
      $snapToken = Snap::getSnapToken($params);
      return $snapToken;
    } catch (\Exception $e) {
      throw new \Exception('Failed to create payment: ' . $e->getMessage());
    }
  }
}
