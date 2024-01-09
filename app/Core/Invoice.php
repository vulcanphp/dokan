<?php

namespace App\Core;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;

class Invoice
{
    protected array $order;

    public function __construct(protected int $invoiceId)
    {
        $this->generateInvoiceInfo();
    }

    public static function webHtml(...$args): string
    {
        return (new Invoice(...$args))
            ->generateHtml();
    }

    protected function generateInvoiceInfo(): void
    {
        $this->order = Order::select(
            'p.*, t1.subtotal, t1.total, t1.method, t1.payment_id, t1.status as payment_status'
        )
            ->leftJoin(Payment::class)
            ->where(['p.id' => $this->invoiceId])
            ->fetch(\PDO::FETCH_ASSOC)
            ->first();

        $this->order['products'] = Product::select(
            'p.title, p.price, t1.quantity'
        )
            ->join(
                OrderItem::class,
                't1.product_id = p.id AND t1.order_id = ' . $this->invoiceId
            )
            ->fetch(\PDO::FETCH_ASSOC)
            ->get()
            ->all();
    }

    public function getOrder(string $key, $default = null)
    {
        return $this->order[$key] ?? $default;
    }

    public function getVatTotal()
    {
        $total = 0;

        foreach ($this->getOrder('products') as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return ($total / 100) * Configurator::$instance->get('vat');
    }

    public function generateHtml(): string
    {
        return view('includes.invoice.index', ['invoice' => $this]);
    }
}
