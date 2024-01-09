<section x-cloak x-show="tab == 'settings'">
    <h2 class="text-2xl font-semibold mb-4"><?= translate('Site Settings') ?></h2>
    <form method="post">
        <?= csrf() ?>
        <input type="hidden" name="action" value="settings">
        <div class="md:flex items-center mb-4">
            <label for="title" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Title') ?></label>
            <input type="text" name="title" id="title" value="<?= $config->get('title', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="Dokan">
        </div>
        <div class="md:flex items-center mb-4">
            <label for="tagline" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Tagline') ?></label>
            <input type="text" name="tagline" id="tagline" value="<?= $config->get('tagline', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="Buy Now, Pay Later">
        </div>
        <div class="md:flex items-start mb-4">
            <label for="description" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Description') ?></label>
            <textarea name="description" id="description" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="Best online shopping store at resounding discounts All across World with cash on delivery"><?= $config->get('description', '') ?></textarea>
        </div>
        <div class="md:flex items-center mb-4">
            <label for="language" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Language') ?></label>
            <select name="language" id="language" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach ([
                    'en' => 'English',
                    'hi' => 'Hindi',
                    'es' => 'Spanish',
                    'fr' => 'French',
                    'ar' => 'Arabic',
                    'bn' => 'Bengali',
                    'pt' => 'Portuguese',
                    'ru' => 'Russian',
                    'ur' => 'Urdu',
                    'id' => 'Indonesian',
                    'de' => 'German',
                    'sw' => 'Swahili',
                    'te' => 'Telugu',
                    'mr' => 'Marathi',
                    'ta' => 'Tamil',
                    'tr' => 'Turkish',
                    'vi' => 'Vietnamese',
                    'ko' => 'Korean',
                    'it' => 'Italian',
                    'yo' => 'Yoruba',
                    'ml' => 'Malayalam',
                    'ha' => 'Hausa',
                    'th' => 'Thai'
                ] as $code => $language) : ?>
                    <option value="<?= $code ?>" <?= $config->get('language', '') == $code ? 'selected' : '' ?>><?= $language ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="md:flex items-center mb-4">
            <label for="copyright" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Copyright Text') ?></label>
            <input type="text" name="copyright" id="copyright" value="<?= $config->get('copyright', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="&copy; 2024 all right reserved.">
        </div>
        <h2 class="text-2xl font-semibold mt-6 mb-4"><?= translate('Payment Settings') ?></h2>
        <div class="md:flex items-center mb-4">
            <label for="currency" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Currency') ?></label>
            <select name="currency" id="currency" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach (App\Core\Currency::$instance->getList() as $code => $currency) : ?>
                    <option value="<?= $code ?>" <?= $config->get('currency', '') == $code ? 'selected' : '' ?>><?= $currency['name'] . ' (' . $currency['symbol_native'] . ')' ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="md:flex items-center mb-4">
            <label for="shipping" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Shipping Fee') ?></label>
            <input type="number" step="any" name="shipping" id="shipping" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="Shipping fee" value="<?= $config->get('shipping', '') ?>">
        </div>
        <div class="md:flex items-center mb-4">
            <label for="vat" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Vat') ?></label>
            <input type="number" step="any" name="vat" id="vat" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="VAT (will be chared as percent)" value="<?= $config->get('vat', '') ?>">
        </div>
        <div class="md:flex items-center mb-4">
            <span class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Cash On Delivery') ?></span>
            <div class="flex items-center select-none w-full md:w-9/12">
                <input type="checkbox" name="cod_enabled" id="cod_enabled" <?= $config->is('cod_enabled') ? 'checked' : '' ?>>
                <label for="cod_enabled" class="ml-2"><?= translate('Enable/Disable') ?></label>
            </div>
        </div>
        <div class="md:flex items-center mb-4">
            <span class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('PayPal Payment') ?></span>
            <div class="flex items-center select-none w-full md:w-9/12">
                <input type="checkbox" name="paypal_enabled" id="paypal_enabled" <?= $config->is('paypal_enabled') ? 'checked' : '' ?>>
                <label for="paypal_enabled" class="ml-2"><?= translate('Enable/Disable') ?></label>
            </div>
        </div>
        <div style="display:<?= $config->is('paypal_enabled') ? 'block' : 'none' ?>">
            <div class="md:flex items-center mb-4">
                <label for="paypal_environment" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Environment') ?></label>
                <select name="paypal_environment" id="paypal_environment" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700">
                    <?php foreach (['sandbox', 'production'] as $mode) : ?>
                        <option value="<?= $mode ?>" <?= $config->get('paypal_environment', '') == $mode ? 'selected' : '' ?>><?= ucfirst($mode) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="md:flex items-center mb-4">
                <label for="paypal_client_id" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Client Id') ?></label>
                <input type="text" name="paypal_client_id" id="paypal_client_id" value="<?= $config->get('paypal_client_id', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="PayPal Client Id">
            </div>
            <div class="md:flex items-center mb-4">
                <label for="paypal_client_secret" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Client Secret') ?></label>
                <input type="text" name="paypal_client_secret" id="paypal_client_secret" value="<?= $config->get('paypal_client_secret', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="PayPal Client Secret">
            </div>
        </div>
        <div class="md:flex items-center mb-4">
            <span class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Stripe Payment') ?></span>
            <div class="flex items-center select-none w-full md:w-9/12">
                <input type="checkbox" name="stripe_enabled" id="stripe_enabled" <?= $config->is('stripe_enabled') ? 'checked' : '' ?>>
                <label for="stripe_enabled" class="ml-2"><?= translate('Enable/Disable') ?></label>
            </div>
        </div>
        <div style="display:<?= $config->is('stripe_enabled') ? 'block' : 'none' ?>">
            <div class="md:flex items-center mb-4">
                <label for="stripe_publishable_key" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Publishable key') ?></label>
                <input type="text" name="stripe_publishable_key" id="stripe_publishable_key" value="<?= $config->get('stripe_publishable_key', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="Publishable key">
            </div>
            <div class="md:flex items-center mb-4">
                <label for="stripe_secret_key" class="md:w-3/12 mb-2 md:mb-0 block"><?= translate('Secret Key') ?></label>
                <input type="text" name="stripe_secret_key" id="stripe_secret_key" value="<?= $config->get('stripe_secret_key', '') ?>" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="Stripe Secret key">
            </div>
        </div>
        <h2 class="text-2xl font-semibold mt-6 mb-4"><?= translate('Global Scripts') ?></h2>
        <div class="md:flex items-start mb-4">
            <label for="head" class="md:w-3/12 block mb-2 md:mb-0"><?= translate('Head Tag') ?></label>
            <textarea name="head" id="head" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="<?= translate('Input Html') ?>"><?= $config->get('head', '') ?></textarea>
        </div>
        <div class="md:flex items-start mb-4">
            <label for="body" class="md:w-3/12 block mb-2 md:mb-0"><?= translate('Body Tag') ?></label>
            <textarea name="body" id="body" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="<?= translate('Input Html') ?>"><?= $config->get('body', '') ?></textarea>
        </div>
        <div class="md:flex items-start mb-4">
            <label for="footer" class="md:w-3/12 block mb-2 md:mb-0"><?= translate('Footer Tag') ?></label>
            <textarea name="footer" id="footer" class="w-full md:w-9/12 px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="<?= translate('Input Html') ?>"><?= $config->get('footer', '') ?></textarea>
        </div>
        <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-4 rounded-full"><?= translate('Save') ?></button>
    </form>
</section>