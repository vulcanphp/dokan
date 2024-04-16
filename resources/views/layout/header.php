<?php

use App\Core\Configurator;
?>
<header class="bg-primary-700 md:fixed z-40 inset-x-0 top-0 py-4 md:py-0">
    <div class="container bg-xbg-800">
        <div class="md:h-16 flex flex-col md:flex-row items-center justify-between">
            <a fire href="<?= home_url() ?>" class="flex items-center text-xamber-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 2H5C3.346 2 2 3.346 2 5v2.831c0 1.053.382 2.01 1 2.746V20a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-5h4v5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-9.424c.618-.735 1-1.692 1-2.746V5c0-1.654-1.346-3-3-3zm1 3v2.831c0 1.14-.849 2.112-1.891 2.167L18 10c-1.103 0-2-.897-2-2V4h3c.552 0 1 .449 1 1zM10 8V4h4v4c0 1.103-.897 2-2 2s-2-.897-2-2zM4 5c0-.551.448-1 1-1h3v4c0 1.103-.897 2-2 2l-.109-.003C4.849 9.943 4 8.971 4 7.831V5zm6 11H6v-3h4v3z"></path>
                </svg>
                <span class="font-semibold text-2xl ml-3"><?= Configurator::$instance->get('title', 'Dokan') ?></span>
            </a>
            <div class="flex items-center">
                <a x-cloak x-show="cart.length > 0" fire href="<?= home_url('cart') ?>" class="flex items-center mt-3 md:mt-0 mr-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-7 text-xamber-700" viewBox="0 0 24 24">
                        <path d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z"></path>
                        <circle cx="10.5" cy="19.5" r="1.5"></circle>
                        <circle cx="16.5" cy="19.5" r="1.5"></circle>
                    </svg>
                    <span class="ml-2 font-semibold text-lg text-gray-200" x-text="cart.length"></span>
                </a>
                <a fire href="<?= home_url('delivery') ?>" class="flex items-center mt-3 md:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 text-xamber-700" viewBox="0 0 24 24">
                        <path d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z"></path>
                    </svg>
                    <span class="ml-1 text-sm font-semibold text-gray-200"><?= translate('Delivery') ?></span>
                </a>
            </div>
            <div class="relative mt-3 md:mt-0" x-data="{search: '', isOpen: true, isLoading: false, fetchResult(){
                    this.isLoading = true
                    fetch('/search?keyword=' + this.search).then(res => res.text()).then(html => {
                        document.querySelector('#searchResult').innerHTML = html, this.isLoading = false, window.fireView.checkFireLinks();
                    });
                }}" @click.away="isOpen = false">
                <input type="text" placeholder="<?= translate("Search (Press '/' to focus)") ?>" x-ref="search" @keydown.window="
                    if(event.keyCode === 191){
                        event.preventDefault();
                        $refs.search.focus();
                    }" @input.debounce.500ms="fetchResult" x-model="search" @focus="isOpen = true" @keydown="isOpen = true" @keydown.escape.window="isOpen = false" @keydown.shift.tab="isOpen = false" class="bg-xbg-700 rounded-full w-72 px-11 py-2 focus:outline-none focus:ring-2 ring-xamber-700/75">
                <div @click="$refs.search.focus();" class="absolute top-0">
                    <svg class="fill-current w-5 text-gray-400 mt-[10px] ml-4" viewBox="0 0 24 24">
                        <path d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"></path>
                    </svg>
                </div>
                <div x-show="isLoading" x-transition class="absolute top-0 right-0" style="display: none;">
                    <svg class="animate-spin fill-current w-5 text-gray-400 mt-[10px] mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <div x-show="isOpen" x-transition id="searchResult" class="absolute z-40 top-full w-full h-max" style="display: none;"></div>
            </div>
        </div>
    </div>
</header>
<div class="md:h-16"></div>