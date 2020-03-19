<?php
try {
    require_once './controller/controller.php';
    getTodoPage();
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
