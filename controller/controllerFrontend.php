<?php

function my_autoload($class)
{
    require 'model/' . $class . '.php';
}
spl_autoload_register('my_autoload');

function home()
{
    $modelManager = new ModelFrontend;
    $lastPost = $modelManager->lastPost();
    require('views/home.php');
}

function form()
{
    $modelManager = new ModelFrontend;
    $modelManager->messageForm(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['firtName']),htmlspecialchars($_POST['email']), $_POST['valid']);
    header('location:index.php?p=home');
}