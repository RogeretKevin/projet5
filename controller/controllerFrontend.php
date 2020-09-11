<?php
//AUTOLOAD COMPOSER
require "vendor/autoload.php";

//PAGE D'ACCUEIL
function home()
{
    $postManager = new Projet5\PostManager;
    $lastPost = $postManager->lastPost();
    require('views/home.php');
}

// ------------------------------------------ARTICLES-----------------------------------------------
//RECUPERE LES ARTICLES
function news(){
    $postManager = new Projet5\PostManager;
    $post = $postManager->getPosts();
    require("views/news.php");
}

//AFFICHE L'ARTICLE PAR ID
function post()
{
    $postManager = new Projet5\PostManager;
    $commentManager = new Projet5\CommentManager;
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    $result = $commentManager->nbComment($_GET['id']);
    require('views/single.php');
}

// -------------------------------------------COMMENTAIRES----------------------------------------------
//AJOUTE UN COMMENTAIRE
function comment()
{
    $commentManager = new Projet5\CommentManager;
    $postManager = new Projet5\PostManager;

    $error = array();
    $pseudo = $_POST['pseudo'];
    $comment = $_POST['comment'];

    if(empty($pseudo) OR empty($comment)){
        array_push($error, "Veuillez entrer toutes les informations !");
    }
    if(strlen($comment) > 255){
        array_push($error, "Votre commentaire comporte plus de 255 caractères !");
    }
    if(strlen($pseudo) > 20){
        array_push($error, "Votre pseudo comporte plus de 20 caractères !");
    }
    if(empty($error)){
        $commentManager->sendComment(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['comment']), $_POST['id_post']);
        $post = $postManager->getPost($_POST['id_post']);
        header('location:index.php?p=post&id=' . $_POST['id_post'] .'#comment');
        exit;
    }
    $post = $postManager->getPost($_POST['id_post']);
    $comments = $commentManager->getComments($_POST['id_post']);
    $result = $commentManager->nbComment($_POST['id_post']);
    require("views/single.php");
}

//REPORT UN COMMENTAIRE
function report()
{
    $commentManager = new Projet5\CommentManager;
    $postManager = new Projet5\PostManager;
    $commentManager->reportComment($_GET['idcomment']);
    $post = $postManager->getPost($_GET['id']);
    header('location:index.php?p=post&id=' . $post['id'] .'#comment');
}

// ------------------------------------------------------------MESSAGES----------------------------------------
//ENVOIE DE MESSAGE DEPUIS LE FORMULAIRE
function form()
{
    $messageManager = new Projet5\MessageManager;

    $error = array();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/', $name)){
        array_push($error, "Votre non comporte des chiffres ou des caractères spéciaux");
    }
    if (!preg_match('/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $email)){
        array_push($error, "Entrez une adresse email valide !");
    }
    if(empty($name) OR empty($email) OR empty($message)){
        array_push($error, "Veuillez entrer toutes les informations !");
    }
    if(strlen($name) > 30){
        array_push($error, "Votre nom comporte plus de 30 caractères !");
    }
    if(strlen($message) > 255){
        array_push($error, "Votre message comporte plus de 255 caractères !");
    }
    if(empty($error)){
        if(!isset($_POST['valid'])){
            $_POST['valid'] = "non";
        }
        $messageManager->messageForm(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['message']), $_POST['valid']);
        header('location:index.php?p=contact');
        exit;
    }
    require('views/contact.php');
}

//PAGE DE CONTACT
function contact()
{
    require('views/contact.php');
}

//PAGE 404
function qcq()
{
    require('views/404.php');
}