<?php ob_start(); ?>
<h2 class="text-xl">A Faire</h2>
<?php
while ($data = $res->fetch()) {
    var_dump($data);
} ?>

<?php
$content = ob_get_clean();
require('template.php'); ?>