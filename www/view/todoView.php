<?php ob_start(); ?>
<section class="p-8">
    <h2 class="text-2xl mb-6">TODO</h2>
    <?php
    while ($data = $unchecked->fetch()) { ?>
        <label class="text-xl block hover:bg-gray">
            <input id="<?= $data['id'] ?>" class="checkbox mr-2 leading-tight" type="checkbox">
            <?= $data['todo'] ?>
        </label>
    <?php } ?>
</section>
<section class="p-8">
    <h2 class="text-2xl mb-6">Archive</h2>
    <?php
    while ($data = $checked->fetch()) { ?>
        <label class="text-xl block line-through text-muted hover:bg-gray">
            <input id="<?= $data['id'] ?>" class="checkbox mr-2 leading-tight" type="checkbox" checked>
            <?= $data['todo'] ?>
        </label>
    <?php } ?>
</section>
<section class="p-8 border-t border-gray">
    <h2 class="text-2xl mb-6">Add a TODO</h2>
    <form>
        <form class="w-full max-w-sm">
            <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="task todo" aria-label="Full name">
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                    ADD
                </button>
            </div>
        </form>
    </form>
</section>


<?php
$content = ob_get_clean();
require('template.php'); ?>