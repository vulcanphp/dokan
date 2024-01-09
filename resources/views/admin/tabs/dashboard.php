<section x-cloak x-show="tab == 'dashboard'">
    <h2 class="text-2xl font-semibold"><?= translate('Welcome to Admin') ?></h2>
    <p class="mb-4"><?= translate('We have assembled some features which you can customize from here.') ?></p>
    <?php $this->include('admin.includes.widgets') ?>
    <form method="post">
        <?= csrf() ?>
        <input type="hidden" name="action" value="configure">
        <div class="mb-2">
            <label for="password" class="mb-2 block"><?= translate('Change Password') ?></label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('New Password') ?>">
        </div>
        <button class="bg-xamber-700 hover:bg-xamber-800 px-3 py-1 text-sm inline-block mt-2 rounded-full"><?= translate('Save Changes') ?></button>
    </form>

    <h2 class="text-2xl font-semibold mt-8 mb-2"><?= translate('Update Manager') ?></h2>
    <p class="italic text-gray-200"><?= translate('Current') ?>: <b><?= config('app.version') ?></b></p>
    <?php

    use VulcanPhp\Core\Helpers\PrettyDateTime;

    $update = $config->get('update');
    if ($update !== null) : ?>
        <p class="mt-1 flex items-center text-gray-300">
            <span><?= translate('Checked') ?>: </span>
            <span class="ml-1"><?= PrettyDateTime::parse(new DateTime($time = date('Y-m-d H:i:s', $update['checked']))) ?> <small class="ml-1 text-gray-200">(<?= $time ?>)</small></span>
        </p>
    <?php endif ?>
    <a href="?action=update-check" class="bg-xamber-700 hover:bg-xamber-800 px-3 py-1 text-sm inline-block mt-4 rounded-full"><?= translate('Check for Update') ?></a>
    <?php if ($update !== null && version_compare($update['version'], config('app.version'), '>')) : ?>
        <div class="mt-6">
            <p class="mt-2 mb-1 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-xamber-700 w-6" viewBox="0 0 24 24">
                    <path d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787 5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0 4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501 6.921 6.921 0 0 0-1.315-.408 7.079 7.079 0 0 0-2.819 0 6.94 6.94 0 0 0-1.316.409 7.04 7.04 0 0 0-3.08 2.534 6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4 4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138 4.943 4.943 0 0 1-1.787.752 5.073 5.073 0 0 1-2.017 0 4.956 4.956 0 0 1-1.787-.752 5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0 7.031 7.031 0 0 0 4.395-2.945 6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4-4 4z"></path>
                </svg>
                <span class="font-semibold text-amber-600 ml-1"><?= translate('Update Available') ?></span>
            </p>
            <p class="italic text-gray-200 mb-4"><?= translate('Version') ?>: <b><?= $update['version'] ?></b></p>
            <a href="?action=update-download" class="bg-xamber-700 hover:bg-xamber-800 px-3 py-1 text-sm inline-block rounded-full"><?= translate('Download Update') ?></a>
        </div>
    <?php endif ?>
    <?php if (!$config->is('remove-donate')) : ?>
        <div class="mt-8">
            <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="vulcandev" data-color="#FFDD00" data-emoji="" data-font="Comic" data-text="Buy me a coffee" data-outline-color="#000000" data-font-color="#000000" data-coffee-color="#ffffff"></script>
            <a href="?action=remove-donate" class="text-sm text-gray-300 hover:text-gray-200 inline-block mt-3">Hide it</a>
        </div>
    <?php endif ?>
</section>