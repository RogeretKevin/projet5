<?php
require('controller/controllerFrontend.php');

if (!isset($_GET['p']) || $_GET['p'] == "home") {
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

// SAUVEGARDE LES MESSAGE DU FORMULAIRE //
else if ($_GET['p'] == 'form') {
    form();
}