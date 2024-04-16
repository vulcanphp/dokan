<section x-cloak x-show="tab == 'category-form'">
    <div class="text-center w-full sm:w-10/12 md:w-8/12 mx-auto">
        <h2 class="font-semibold text-2xl mb-4"><?= translate('Add/Edit Category') ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?= csrf() ?>
            <input type="hidden" name="action" value="category">
            <input type="hidden" name="id" x-model="category.id">
            <input type="hidden" name="image" x-model="category.image">
            <input type="text" name="title" x-model="category.title" class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Category Title') ?>">
            <input type="file" name="image" class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
            <template x-if='category.image'>
                <img :src="'<?= storage_url() ?>' + category.image" class="w-24 border border-xbg-600/50 p-1 rounded-lg" alt="">
            </template>
            <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-2 rounded-full"><?= translate('Save') ?></button>
        </form>
    </div>
</section>