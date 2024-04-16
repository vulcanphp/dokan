<div class="flex flex-row flex-wrap justify-center md:justify-start mx-[-8px]">
    <?php foreach ($categories as $cat) : ?>
        <?php $this->component('components.category-card', ['category' => $cat, 'active' => $category == $cat->id]) ?>
    <?php endforeach ?>
</div>