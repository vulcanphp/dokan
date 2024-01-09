<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' =>  $product->title . ' - ' . Configurator::$instance->get('title', 'Dokan'),
        'image' => storage_url($product->image)
    ])
    ->with([
        'product' => $product,
        'related' => $related,
    ]);

?>

<section>
    <?php $this
        ->include('includes.product.info')
        ->include('includes.product.description')
        ->include('includes.product.related')
    ?>
</section>