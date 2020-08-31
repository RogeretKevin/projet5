<?php
//AUTOLOAD COMPOSER
require "../vendor/autoload.php";

//PAGE DU DASHBOARD
function home()
{
    $modelBackend = new Projet5\ModelBackend;
    $countPost = $modelBackend->countPost()[0];
    $countMessage = $modelBackend->countMessage()[0];
    $countComment = $modelBackend->countComment()[0];
    require('views/dashboard.php');
}

//LISTE DES ARTICLES
function articlesList()
{
    $modelBackend = new Projet5\ModelBackend;
    $count = intval($modelBackend->countPost()[0]);
    $limit = 5;
    $page = intval($_GET['page']);
    $nbPages = ceil($count / $limit);
    if ($page < 1 OR $page > $nbPages):
        $page = 1;
    endif;
    $offset = $limit * ($page - 1);
    $next = $page + 1;
    $previous = $page - 1;
    $listArticles = $modelBackend->getListPosts($limit, $offset);
    require('views/liste_articles.php');
}

//PAGE D'EDITION
function viewEdit()
{
    $modelBackend = new Projet5\ModelBackend;
    $post = $modelBackend->getPost($_GET['id']);
    require('views/edit.php');
}

//MODIFIE L'ARTICLE
function edit()
{
    $modelBackend = new Projet5\ModelBackend;
    $targetDir = "../asset/images_posts/";
    $targetDirRelativeToSite = "./asset/images_posts/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $targetFilePathForSite = $targetDirRelativeToSite . $fileName;

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
    $modelBackend->editPost(htmlspecialchars($_POST['newtitle']), strip_tags($_POST['newtext']), strip_tags($_POST['id']), $targetFilePathForSite);
    header('location:index.php?p=list&page=1');
}

//CREER UN ARTICLE
function create()
{
    $modelBackend = new Projet5\ModelBackend;
    $targetDir = "../asset/images_posts/";
    $targetDirRelativeToSite = "./asset/images_posts/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $targetFilePathForSite = $targetDirRelativeToSite . $fileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
    $modelBackend->createPost(strip_tags($_POST['title']), strip_tags($_POST['content']), $targetFilePathForSite);
    header('location:index.php?p=list&page=1');
}

//LISTE DES MESSAGES
function messagesList()
{
    $modelBackend = new Projet5\ModelBackend;
    $count = intval($modelBackend->countMessage()[0]);
    $limit = 5;
    $page = intval($_GET['page']);
    $nbPages = ceil($count / $limit);
    if ($page < 1 OR $page > $nbPages):
        $page = 1;
    endif;
    $offset = $limit * ($page - 1);
    $next = $page + 1;
    $previous = $page - 1;
    $listMessages = $modelBackend->getListMessages($limit, $offset);
    require('views/mailbox.php');
}

//LECTURE DE MESSAGE
function readMessage()
{
    $modelBackend = new Projet5\ModelBackend;
    $modelBackend->messageRead($_GET['id']);
    $message = $modelBackend->getMessage($_GET['id']);
    require('views/read-mail.php');
}

//SUPPRIME UN ARTICLE
function deletePosts()
{
    $modelBackend = new Projet5\ModelBackend;
    $modelBackend->deletePost($_GET['id']);
    header('location:index.php?p=list&page=1');
}

//SUPPRIME UN MESSAGE
function deleteMessages()
{
    $modelBackend = new Projet5\ModelBackend;
    $modelBackend->deleteMessage($_GET['id']);
    header('location:index.php?p=message&page=1');
}

//LOGIN
function login()
{
    $error = "";
    $modelBackend = new Projet5\ModelBackend;
    $login = $modelBackend->checkpseudo($_POST['pseudo']);
    $isPasswordCorrect = password_verify($_POST['pass'], $login['password']);

    if (!$login):
        $error = "Mauvais identifiant ou mot de passe !";
        require('views/login.php');
    else:
        if ($isPasswordCorrect):
            
            if (isset($_POST["remember"])):
                setcookie('admin', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
                header('location:index.php');
            else:
                session_start();
                $_SESSION['admin'] = $_POST['pseudo'];
                header('location:index.php');
            endif;
        else:
            $error = "Mauvais identifiant ou mot de passe !";
            require('views/login.php');
        endif;
    endif;
}

//LOGOUT
function logout()
{
    session_start();
    session_destroy();
    setcookie('admin', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
    header('location:index.php');
}