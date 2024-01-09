<?php

use App\Core\Configurator;

$this
    ->layout('admin.layout')
    ->block('title', 'Admin - ' . Configurator::$instance->get('title', 'CoPlay'))
    ->with(['config' => $config])
?>

<main class="container flex flex-row flex-wrap" x-data="{
    tab: $persist('dashboard'),
    menuOpen: window.matchMedia('(min-width: 768px)').matches,
    category: {id:'', title:'', image: ''},
    product: {id:'', title:'', image: '', price: '', quantity: '', description: ''},
    order: {id:'', name:'', email: '', phone: '', quantity: '', address: '', status: ''},
    payment: {id:'', order_id:'', subtotal: '', total: '', method: '', payment_id: '', status: ''},
    newCategory() {
        this.tab = 'category-form', this.category = {id: '', title: '', image: ''};
    },
    editCategory(category) {
        this.category = category, this.tab = 'category-form';
    },
    newProduct() {
        this.tab = 'product-form', this.product = {id:'', title:'', image: '', price: '', quantity: '', description: ''};
    },
    editProduct(product) {
        this.product = product, this.tab = 'product-form';
    },
    newOrder() {
        this.tab = 'order-form', this.order = {id:'', name:'', email: '', phone: '', quantity: '', address: '', status: ''};
    },
    editOrder(order) {
        this.order = order, this.tab = 'order-form';
    },
    newPayment() {
        this.tab = 'payment-form', this.payment = {id:'', order_id:'', subtotal: '', total: '', method: '', payment_id: '', status: ''};
    },
    editPayment(payment) {
        this.payment = payment, this.tab = 'payment-form';
    }
}">
    <?php $this
        ->include('admin.includes.header')
        ->include('admin.includes.sidebar')
    ?>

    <div class="w-full md:w-9/12 mb-6">
        <?php $this
            ->include('admin.tabs.dashboard')
            ->include('admin.tabs.category', ['category' => $category])
            ->include('admin.tabs.product', ['product' => $product])
            ->include('admin.tabs.order', ['order' => $order])
            ->include('admin.tabs.payment', ['payment' => $payment])
            ->include('admin.tabs.settings')
            ->include('admin.form.category')
            ->include('admin.form.product', ['categories' => $cat_list])
            ->include('admin.form.order')
            ->include('admin.form.payment')
        ?>
    </div>
</main>