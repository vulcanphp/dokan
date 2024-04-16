<section x-cloak x-show="tab == 'product'">
    <div class="flex items-center justify-between mb-4">
        <button @click="newProduct()" class="bg-xamber-700 hover:bg-xamber-800 px-4 py-1 rounded"><?= translate('+ New') ?></button>
        <form x-ref="productSearch">
            <input type="search" name="search-product" value="<?= input('search-product') ?>" @input.debounce.800ms="$refs.productSearch.submit();" class="px-4 py-[6px] bg-xbg-700 text-center rounded-full outline-none focus:outline-xamber-700" placeholder="<?= translate('Product Title/ID') ?>">
        </form>
    </div>
    <table class="w-full">
        <thead class="bg-xbg-600">
            <tr>
                <th class="px-4 py-2 text-left rounded-tl"><?= translate('Title') ?></th>
                <th class="px-4 py-2 text-left rounded-tl"><?= translate('Price') ?></th>
                <th class="px-4 py-2 text-left hidden md:table-cell"><?= translate('Quantity') ?></th>
                <th class="px-4 py-2 text-left rounded-tr"><?= translate('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php

            use App\Core\Currency;

            if (!$product->hasData()) : ?>
                <tr>
                    <td class="text-center px-4 py-2 text-gray-300 bg-xbg-700 rounded-b" colspan="4"><?= translate('Product Table is Empty') ?></td>
                </tr>
            <?php endif ?>
            <?php foreach ($product->getData() as $key => $item) : ?>
                <?php $last = count($product->getData()) == $key + 1 ?>
                <tr class="bg-xbg-700">
                    <td class="px-4 py-2 text-left <?= $last ? 'rounded-bl' : '' ?>"><?= $item->title ?></td>
                    <td class="px-4 py-2"><?= Currency::$instance->format($item->price, 'text-sm') ?></td>
                    <td class="px-4 py-2 hidden md:table-cell"><?= $item->quantity ?></td>
                    <td class="px-4 py-2 <?= $last ? 'rounded-br' : '' ?>">
                        <button @click='editProduct(<?= json_encode($item->toArray()) ?>)' class="text-xs sm:text-sm px-2 rounded inline-block bg-yellow-600 hover:bg-yellow-700 ml-1"><?= translate('Edit') ?></button>
                        <a onclick="return confirm('Are you sure to delete this')" href="?action=delete-product&id=<?= $item->id ?>" class="text-xs sm:text-sm px-2 rounded inline-block bg-rose-600 hover:bg-rose-700 ml-1"><?= translate('Delete') ?></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if ($product->hasLinks()) : ?>
        <div class="flex justify-center mt-4">
            <?= $product->getLinks(1) ?>
        </div>
    <?php endif ?>
</section>