<?php
require('controller/controllerFrontend.php');

if (!isset($_GET['p'])) {
    home();
}

// AFFICHE LE CHAPITRE //
else if ($_GET['p'] == 'post') {
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        post();
    }
    else {
        header('location:index.php?p=post&id=1');
    }
}