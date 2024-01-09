<a href="<?= $category->getSlug() ?>" class="flex items-center <?= $active ? 'bg-xbg-600' : 'bg-xbg-700 hover:bg-xbg-600' ?> rounded-2xl px-4 py-2 m-[8px] transition ease-in-out duration-150">
    <?php if (isset($category->image)) : ?>
        <img class="w-[40px] h-[40px] rounded-full" src="<?= storage_url($category->image) ?>" alt="<?= $category->title ?>">
    <?php else : ?>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] fill-current opacity-50" viewBox="0 0 24 24">
            <path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8 8a2 2 0 0 0 2.828 0l7.172-7.172a2 2 0 0 0 0-2.828l-8-8zM7 9a2 2 0 1 1 .001-4.001A2 2 0 0 1 7 9z"></path>
        </svg>
    <?php endif ?>
    <span class="ml-1 font-semibold"><?= $category->title ?></span>
</a>