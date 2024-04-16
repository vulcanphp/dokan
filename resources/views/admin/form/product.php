<section x-cloak x-show="tab == 'product-form'">
    <div class="text-center w-full sm:w-10/12 md:w-8/12 mx-auto">
        <h2 class="font-semibold text-2xl mb-4"><?= translate('Add/Edit Product') ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?= csrf() ?>
            <input type="hidden" name="action" value="product">
            <input type="hidden" name="id" x-model="product.id">
            <input type="hidden" name="image" x-model="product.image">
            <input type="text" name="title" x-model="product.title" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Product Title') ?>">
            <div class="flex">
                <div class="w-6/12 pr-2">
                    <input type="number" min="1" max="999999" required step="any" name="price" x-model="product.price" class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Product Price') ?>">
                </div>
                <div class="w-6/12 pl-2">
                    <input type="number" name="quantity" required x-model="product.quantity" class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Product Quantity') ?>">
                </div>
            </div>
            <select name="category" x-model="product.category" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach ($categories as $id => $title) : ?>
                    <option value="<?= $id ?>"><?= $title ?></option>
                <?php endforeach ?>
            </select>
            <input type="file" name="image" class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
            <template x-if='product.image'>
                <img :src="'<?= storage_url() ?>' + product.image" class="w-24 mb-4 border border-xbg-600/50 p-1 rounded-lg" alt="">
            </template>
            <textarea name="description" rows="4" x-model="product.description" class="mb-4 w-full px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="Product Description"></textarea>
            <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-2 rounded-full"><?= translate('Save') ?></button>
        </form>
    </div>
</section>