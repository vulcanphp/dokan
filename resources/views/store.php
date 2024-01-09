<?php

$this
    ->layout('layout.master')
    ->block('title', 'Welcome to Dokan')
    ->with([
        'categories' => $categories,
        'products' => $products,
        'category' => $category,
    ])
    ->include('includes.category')
    ->include('includes.products');
