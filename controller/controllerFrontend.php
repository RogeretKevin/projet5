<?php
require_once('model/ModelFrontend.php');

function home()
{
    $modelManager = new ModelFrontend();
    $lastPost = $modelManager->lastPost();
    require('views/home.php');
}