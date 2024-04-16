<?php if (isset($product->description) && !empty($product->description)) : ?>
    <div class="mt-8 bg-xbg-700 px-4 py-2 md:px-6 md:py-4 rounded-2xl" x-data="{toggleMore: false}">
        <?php
        $words = str_ireplace(["\n"], ['<br/>'], html_entity_decode($product->description ?? ''));
        $words = explode(' ', $words);

        if (count($words) > 35) {
            echo join(' ', array_slice($words, 0, 35));
            echo '<span x-cloak x-show="!toggleMore">...</span>';
            echo '<span x-cloak x-show="toggleMore" x-transition>';
            echo ' ' . join(' ', array_slice($words, 35));
            echo '</span>';
            echo '<button @click="toggleMore = !toggleMore" class="block mx-auto md:mx-0 underline hover:text-gray-100" x-text="toggleMore ?' . "'" . translate('Read less') . "'" . ' : ' . "'" . translate('Read more') . "'" . ' "></button>';
        } else {
            echo join(' ', $words);
        }
        ?>
    </div>
<?php endif ?>