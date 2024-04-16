<section x-cloak x-show="tab == 'category'">
    <div class="flex items-center justify-between mb-4">
        <button @click="newCategory()" class="bg-xamber-700 hover:bg-xamber-800 px-4 py-1 rounded"><?= translate('+ New') ?></button>
        <form x-ref="categorySearch">
            <input type="search" name="search-cat" value="<?= input('search-cat') ?>" @input.debounce.800ms="$refs.categorySearch.submit();" class="px-4 py-[6px] bg-xbg-700 text-center rounded-full outline-none focus:outline-xamber-700" placeholder="<?= translate('Category Title') ?>">
        </form>
    </div>
    <table class="w-full">
        <thead class="bg-xbg-600">
            <tr>
                <th class="px-4 py-2 text-left rounded-tl"><?= translate('Title') ?></th>
                <th class="px-4 py-2 text-left hidden md:table-cell"><?= translate('Image') ?></th>
                <th class="px-4 py-2 text-left rounded-tr"><?= translate('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$category->hasData()) : ?>
                <tr>
                    <td class="text-center px-4 py-2 text-gray-300 bg-xbg-700 rounded-b" colspan="3"><?= translate('Category Table is Empty') ?></td>
                </tr>
            <?php endif ?>
            <?php foreach ($category->getData() as $key => $cat) : ?>
                <?php $last = count($category->getData()) == $key + 1 ?>
                <tr class="bg-xbg-700">
                    <td class="px-4 py-2 text-left <?= $last ? 'rounded-bl' : '' ?>"><?= $cat->title ?></td>
                    <td class="px-4 py-2 hidden md:table-cell"><img class="w-14 border border-xbg-600 p-1 rounded-lg" src="<?= storage_url($cat->image) ?>" alt=""></td>
                    <td class="px-4 py-2 <?= $last ? 'rounded-br' : '' ?>">
                        <button @click='editCategory(<?= json_encode($cat->toArray()) ?>)' class="text-xs sm:text-sm px-2 rounded inline-block bg-yellow-600 hover:bg-yellow-700 ml-1"><?= translate('Edit') ?></button>
                        <a onclick="return confirm('Are you sure to delete this')" href="?action=delete-category&id=<?= $cat->id ?>" class="text-xs sm:text-sm px-2 rounded inline-block bg-rose-600 hover:bg-rose-700 ml-1"><?= translate('Delete') ?></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if ($category->hasLinks()) : ?>
        <div class="flex justify-center mt-4">
            <?= $category->getLinks(1) ?>
        </div>
    <?php endif ?>
</section>