<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => Configurator::$instance->get('title', 'Dokan') . ' - ' . Configurator::$instance->get('tagline', 'Buy Now, Pay Later')
    ])
    ->with([
        'categories' => $categories,
        'products' => $products,
        'category' => $category,
    ])
    ->include('includes.category')
    ->include('includes.products');
