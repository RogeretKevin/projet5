<?php
//AUTOLOAD COMPOSER
require "vendor/autoload.php";

//PAGE D'ACCUEIL
function home()
{
    $modelFrontend = new Projet5\ModelFrontend;
    $lastPost = $modelFrontend->lastPost();
    require('views/home.php');
}

//AFFICHE LE POST PAR ID
function post()
{
    $modelFrontend = new Projet5\ModelFrontend;
    $post = $modelFrontend->getPost($_GET['id']);
    $comments = $modelFrontend->getComments($_GET['id']);
    $result = $modelFrontend->nbComment($_GET['id']);
    require('views/single.php');
}

//ENVOIE DE MESSAGE DEPUIS LE FORMULAIRE
function form()
{
    $modelFrontend = new Projet5\ModelFrontend;

    $error = array();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/', $name)):
        array_push($error, "Votre non comporte des chiffres ou des caractères spéciaux");
    endif;
    if (!preg_match('/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $email)):
        array_push($error, "Entrez une adresse email valide !");
    endif;
    if(empty($name) OR empty($email) OR empty($message)):
        array_push($error, "Veuillez entrer toutes les informations !");
    endif;
    if(strlen($name) > 30):
        array_push($error, "Votre nom comporte plus de 30 caractères !");
    endif;
    if(strlen($message) > 255):
        array_push($error, "Votre message comporte plus de 255 caractères !");
    endif;
    if(empty($error)):
        if(!isset($_POST['valid'])):
        $_POST['valid'] = "non";
        endif;
        $modelFrontend->messageForm(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['message']), $_POST['valid']);
        header('location:index.php?p=contact');
        exit;
    endif;
    require('views/contact.php');
}

//RECUPERE LES ARTICLES
function news(){
    $modelFrontend = new Projet5\ModelFrontend;
    $post = $modelFrontend->getPosts();
    require("views/news.php");
}

//AJOUTE UN COMMENTAIRE
function comment()
{
    $modelFrontend = new Projet5\ModelFrontend;

    $error = array();
    $pseudo = $_POST['pseudo'];
    $comment = $_POST['comment'];

    if(empty($pseudo) OR empty($comment)):
        array_push($error, "Veuillez entrer toutes les informations !");
    endif;
    if(strlen($comment) > 255):
        array_push($error, "Votre commentaire comporte plus de 255 caractères !");
    endif;
    if(strlen($pseudo) > 20):
        array_push($error, "Votre pseudo comporte plus de 20 caractères !");
    endif;
    if(empty($error)):
        $modelFrontend->sendComment(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['comment']), $_POST['id_post']);
        $post = $modelFrontend->getPost($_POST['id_post']);
        header('location:index.php?p=post&id=' . $_POST['id_post'] .'#comment');
        exit;
    endif;
    $post = $modelFrontend->getPost($_POST['id_post']);
    $comments = $modelFrontend->getComments($_POST['id_post']);
    $result = $modelFrontend->nbComment($_POST['id_post']);
    require("views/single.php");
}

//REPORT UN COMMENTAIRE
function report()
{
    $modelFrontend = new Projet5\ModelFrontend;
    $modelFrontend->reportComment($_GET['idcomment']);
    $post = $modelFrontend->getPost($_GET['id']);
    header('location:index.php?p=post&id=' . $post['id'] .'#comment');
}