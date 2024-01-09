<!DOCTYPE html>
<html lang="<?= __lang() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->getBlock('title') ?></title>
    <?= mixer()
        ->enque('css', resource_url('assets/dist/bundle.min.css'))
        ->deque('css')
    ?>
</head>

<body class="print:w-full print:p-0 w-11/12 sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12 mx-auto">

    <div class="my-8 border rounded-lg shadow-sm print:my-0 print:rounded-none print:shadow-none print:border-0">
        {{content}}
    </div>

    <div class="text-center print:hidden mb-8">
        <button onclick="window.print();" class="bg-xamber-700 shadow-sm shadow-xamber-700/50 hover:bg-xamber-800 px-6 py-1 rounded-full text-white font-semibold"><?= translate('Print')?></button>
    </div>

</body>

</html>