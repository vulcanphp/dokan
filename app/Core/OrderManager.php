<?php

namespace App\Core;

use App\Core\Payments\Payments;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Exception;

class OrderManager
{
    protected array $products = [];

    public function __construct($source = null)
    {
        if ($source != null) {
            $this->products = $this->parseProducts($source);
        }
    }

    public static function create(...$args): OrderManager
    {
        return new OrderManager(...$args);
    }

    public function place(): void
    {
        if (empty($this->products)) {
            throw new Exception('Invalid Source of Products', 100);
        }

        // validate payment info
        $payment = Payments::$instance->getPayment(input('method'))
            ->validate(
                $this->getCartTotal(),
                (array) decode_string(input('payment'))
            );

        // 1. store order details
        $order_id = (new Order)->input()->save();
        if (!$order_id) {
            throw new Exception('Failed to Create Order', 102);
        }

        // 2. store payment details
        $payment_id = (new Payment)->load([
            'order_id'      => $order_id,
            'subtotal'      => $this->getCartSubTotal(),
            'total'         => $this->getCartTotal(),
            'payment_id'    => $payment['id'] ?? 'N/A',
            'method'        => input('method'),
            'status'        => $payment['status'] ?? 'pending'
        ])->save();
        if (!$payment_id) {
            throw new Exception('Failed to Store Payment Details', 103);
        }

        // 3. store ordered products
        if (!OrderItem::create(
            collect($this->products)
                ->map(fn ($product) => [
                    'order_id'      => $order_id,
                    'product_id'    => $product->id,
                    'quantity'      => $product->reserve
                ])->all()
        )) {
            throw new Exception('Failed to Store Order Items', 104);
        }

        // 4. reduce products quantity
        if (!Product::create(
            collect($this->products)
                ->map(function ($product) {
                    $product->quantity = ($product->quantity - $product->reserve > 0 ? $product->quantity - $product->reserve : 0);
                    unset($product->reserve);
                    return $product->toArray();
                })->all(),
            ['conflict' => ['id'], 'update' => ['quantity' => 'quantity']]
        )) {
            throw new Exception('Failed to Update Product Quantity', 105);
        }

        // 5. send success message
        redirect(url('success') . '?order=' . base64_encode($order_id));
    }

    protected function getCartSubTotal()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->price * $product->reserve;
        }

        return $total;
    }

    protected function getCartTotal()
    {
        $total = $this->getCartSubTotal();

        if (Configurator::$instance->has('vat')) {
            $total += ($total / 100) * Configurator::$instance->get('vat');
        }

        $total += Configurator::$instance->get('shipping', 0);

        return round($total, Currency::$instance->getCurrency()['decimal']);
    }

    protected function parseProducts($source): array
    {
        if (is_string($source)) {
            $source = decode_string($source);
        }

        if (is_array($source) && !$source[0] instanceof Product) {
            $source = Product::whereIn('id', array_column($source, 'id'))
                ->get()
                ->map(function ($product) use ($source) {
                    foreach ($source as $s) {
                        if ($s['id'] == $product->id) {
                            $product->reserve = $s['quantity'];
                            break;
                        }
                    }
                    return $product;
                })
                ->all();
        }

        return is_array($source) ? $source : [];
    }
}
