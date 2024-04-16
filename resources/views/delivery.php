<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Delivery - ' . Configurator::$instance->get('title', 'Dokan'),
    ])
?>
<section x-data="{track: $persist(''), trackLoading: false, trackResult(){
    this.trackLoading = true
    fetch('/myorders?keyword=' + this.track).then(res => res.text()).then(html => {
        document.querySelector('#trackResult').innerHTML = html, this.trackLoading = false, window.fireView.checkFireLinks();
    });
}}">
    <div class="w-full sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto">
        <h2 class="text-2xl text-center font-semibold mb-4"><?= translate('Track Delivery') ?></h2>
        <div class="relative">
            <input type="text" @input.debounce.500ms="trackResult" x-model="track" placeholder="<?= translate('Enter Email or Phone') ?>" class="text-center bg-xbg-700 w-full rounded-full px-6 py-3 md:px-8 md:py-4 focus:outline-none focus:ring-2 ring-xamber-700/75">
            <div x-show="trackLoading" x-transition class="absolute top-0 right-0" style="display: none;">
                <svg class="animate-spin fill-current w-6 text-gray-400 mt-3 md:mt-4 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
    <div id="trackResult" x-init="trackResult()"></div>
</section>