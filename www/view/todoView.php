<?php ob_start(); ?>
<section class="p-8">
    <h2 class="text-2xl mb-6">TODO</h2>
    <ul id='todo'>
        <?php
        while ($data = $unchecked->fetch()) { ?>
            <li class="hover:bg-gray">
                <input id="<?= $data['id'] ?>" class="checkbox mr-2 leading-tight" type="checkbox" name="checkbox-<?=$data['id'] ?>">
                <label class="text-xl" for="<?=$data['id'] ?>">
                    <?= $data['todo'] ?>
                </label>
            </li>
        <?php } ?>
    </ul>
</section>
<section class="p-8">
    <h2 class="text-2xl mb-6">Archive</h2>
    <ul id='done'>
        <?php
        while ($data = $checked->fetch()) { ?>
            <li class="text-xl line-through text-muted hover:bg-gray">
                <input id="<?= $data['id'] ?>" class="checkbox mr-2 leading-tight" name="chbx" type="checkbox" checked>
                <label for="<?= $data['id'] ?>">
                    <?= $data['todo'] ?>
                </label>
            </li>
        <?php } ?>
    </ul>
</section>
<section class="p-8 border-t border-gray">
    <h2 class="text-2xl mb-6">Add a TODO</h2>
    <div>
        <form id="myForm" name="myForm" class="w-full max-w">
            <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" name="content" type="text" placeholder="task todo" aria-label="content">
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                    ADD
                </button>
            </div>
        </form>
    </div>
</section>


<?php
$content = ob_get_clean();
require('template.php'); ?>