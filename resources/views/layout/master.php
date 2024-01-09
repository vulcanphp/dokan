<?php

use App\Core\Configurator;

if (!isset($config)) {
    $this->with(['config' => $config = Configurator::$instance]);
}
?>
<!DOCTYPE html>
<html lang="<?= __lang() ?>">

<head>
    <?= $this
        ->setMeta('language', __lang())
        ->setMeta('url', url()->absoluteUrl())
        ->setMeta('sitename', $config->get('title', 'Dokan'))
        ->setMeta('title', $config->get('title', 'Dokan') . ' - ' . $config->get('tagline', 'Buy Now, Pay Later'))
        ->setMeta('description', $config->get('description', 'Best online shopping store at resounding discounts All across World with cash on delivery.'))
        ->siteMeta()
    ?>
    <link rel="icon" type="image/x-icon" href="<?= resource_url('assets/favicon.png') ?>">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <?= mixer()
        ->enque('css', resource_url('assets/dist/bundle.min.css'))
        ->deque('css')
    ?>
    <script defer src="<?= resource_url('assets/dist/bundle.min.js') ?>"></script>
    <?= $config->get('head', '') ?>
</head>
<?= $config->get('body', '') ?>

<!-- @body tag will be added to cart storage section -->
<?php $this->include('includes.cart.storage') ?>

<?php $this->include('layout.header') ?>

<main class="container my-5">
    {{content}}
</main>

<?php $this->include('layout.footer') ?>

<?= $config->get('footer', '') ?>
<!-- @body tag end -->
</body>

</html>