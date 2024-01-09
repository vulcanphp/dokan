<?php

use App\Core\Configurator;

$this->layout('admin.layout')
    ->block('title', 'Configure - ' . Configurator::$instance->get('title', 'Dokan'));
?>

<div class="w-full h-screen flex items-center justify-center">
    <form method="post" class="w-10/12 sm:w-8/12 md:w-6/12 lg:w-4/12 xl:w-2/12 text-center">
        <a href="<?= home_url() ?>" class="flex items-center justify-center mb-6 text-xamber-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 2H5C3.346 2 2 3.346 2 5v2.831c0 1.053.382 2.01 1 2.746V20a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-5h4v5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-9.424c.618-.735 1-1.692 1-2.746V5c0-1.654-1.346-3-3-3zm1 3v2.831c0 1.14-.849 2.112-1.891 2.167L18 10c-1.103 0-2-.897-2-2V4h3c.552 0 1 .449 1 1zM10 8V4h4v4c0 1.103-.897 2-2 2s-2-.897-2-2zM4 5c0-.551.448-1 1-1h3v4c0 1.103-.897 2-2 2l-.109-.003C4.849 9.943 4 8.971 4 7.831V5zm6 11H6v-3h4v3z"></path>
            </svg>
            <span class="font-semibold text-2xl ml-3"><?= Configurator::$instance->get('title', 'Dokan') ?></span>
        </a>
        <?= csrf() ?>
        <input type="password" required class="w-full px-4 py-2 mb-4 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('New Password') ?>" name="password">
        <input type="password" required class="w-full px-4 py-2 mb-4 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Confirm Password') ?>" name="confirm">
        <p class="text-rose-200 font-semibold text-sm"><?= translate('Note: Save your password somewhere safe, in this version you wont be able recover password if forget.') ?></p>
        <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-4 rounded-full"><?= translate('Configure') ?></button>
    </form>
</div>