<?php
//AUTOLOAD COMPOSER
require "../vendor/autoload.php";

//PAGE DU DASHBOARD
function home()
{
    $postManager = new Projet5\PostManager;
    $messageManager = new Projet5\MessageManager;
    $commentManager = new Projet5\CommentManager;
    $countPost = $postManager->countPost()[0];
    $countMessage = $messageManager->countMessage()[0];
    $countComment = $commentManager->countComments()[0];
    require('views/dashboard.php');
}

// ------------------------------------------ARTICLES-----------------------------------------------
//LISTE DES ARTICLES
function articlesList()
{
    $postManager = new Projet5\PostManager;
    $count = intval($postManager->countPost()[0]);
    $limit = 5;
    $page = intval($_GET['page']);
    $nbPages = ceil($count / $limit);
    if ($page < 1 OR $page > $nbPages){
        $page = 1;
    }
    $offset = $limit * ($page - 1);
    $next = $page + 1;
    $previous = $page - 1;
    $listArticles = $postManager->getListPosts($limit, $offset);
    require('views/liste_articles.php');
}

//PAGE D'EDITION
function viewEdit()
{
    $postManager = new Projet5\PostManager;
    $post = $postManager->getPost($_GET['id']);
    require('views/edit.php');
}

//MODIFIE L'ARTICLE
function edit()
{
    $postManager = new Projet5\PostManager;
    
    if(strlen($_FILES["file"]["name"]) == 0){
        $targetFilePathForSite = $_POST['image'];
        $postManager->editPost(htmlspecialchars($_POST['newtitle']), strip_tags($_POST['newtext']), strip_tags($_POST['id']), $targetFilePathForSite);
        header('location:index.php?p=list&page=1');
    }
    else{
        $infosfichier = pathinfo($_FILES['file']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extensions_autorisees)){
            // Verification format image
            $fileName = basename($_FILES["file"]["name"]);
            $targetDir = "../asset/images_posts/";
            $targetDirRelativeToSite = "./asset/images_posts/";
            $targetFilePath = $targetDir . $fileName;
            $targetFilePathForSite = $targetDirRelativeToSite . $fileName;
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
            $postManager->editPost(htmlspecialchars($_POST['newtitle']), strip_tags($_POST['newtext']), strip_tags($_POST['id']), $targetFilePathForSite);
            header('location:index.php?p=list&page=1');
        }
        else{
            $title = $_POST['newtitle'];
            $content = $_POST['newtext'];
            $id = $_POST['id'];
            $image = $_POST['image'];
            $error = true;
            require('views/edit.php');
        }
    }
}

//CREER UN ARTICLE
function create()
{
    $postManager = new Projet5\PostManager;

    // Verification format image
    $infosfichier = pathinfo($_FILES['file']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

    if (in_array($extension_upload, $extensions_autorisees)){
        $fileName = basename($_FILES["file"]["name"]);
        $targetDir = "../asset/images_posts/";
        $targetDirRelativeToSite = "./asset/images_posts/";
        $targetFilePath = $targetDir . $fileName;
        $targetFilePathForSite = $targetDirRelativeToSite . $fileName;
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        $postManager->createPost(strip_tags($_POST['title']), strip_tags($_POST['content']), $targetFilePathForSite);
        header('location:index.php?p=list&page=1');
    }
    else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $error = true;
        require('views/create.php');
    }
}

//SUPPRIME UN ARTICLE
function deletePosts()
{
    $postManager = new Projet5\PostManager;
    session_start();
    if(isset($_COOKIE['admin']) OR isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $postManager->deletePost($_GET['id']);
        header('location:index.php?p=list&page=1');
    }
    else{
        header('location:index.php?p=login_page');
    }
}

//PAGE CREER UN ARTICLE
function viewCreate()
{
    require('views/create.php');
}

// -----------------------------------------------COMMENTAIRES------------------------------------------
//LISTE DES COMMENTAIRES
function comment()
{
    $commentManager = new Projet5\CommentManager;
    $count = intval($commentManager->countComment($_GET['id'])[0]);
    $limit = 5;
    $page = intval($_GET['page']);
    $nbPages = ceil($count / $limit);
    if ($page < 1 OR $page > $nbPages){
        $page = 1;
    }
    $offset = $limit * ($page - 1);
    $next = $page + 1;
    $previous = $page - 1;
    $listComment = $commentManager->getListComments($_GET['id'], $limit, $offset);
    require('views/liste_comment.php');
}

//LECTURE DE COMMENTAIRE
function readComment()
{
    $commentManager = new Projet5\CommentManager;
    $comment = $commentManager->getComment($_GET['id']);
    require('views/read-comment.php');
}

//VALIDE UN COMMENTAIRE
function validComments()
{
    $commentManager = new Projet5\CommentManager;
    $post = $commentManager->validComment($_GET['id']);
    header('location:index.php?p=read_comment&id=' . $_GET['id']);
}

//SUPPRIME UN COMMENTAIRE
function deleteComments()
{
    $commentManager = new Projet5\CommentManager;
    session_start();
    if(isset($_COOKIE['admin']) OR isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $commentManager->deleteComment($_GET['id']);
        header('location:index.php?p=comment&page=1&id=' . $_GET['id']);
    }
    else{
        header('location:index.php?p=login_page');
    }
}

// -----------------------------------------MESSAGES-------------------------------------------
//LISTE DES MESSAGES
function messagesList()
{
    $messageManager = new Projet5\MessageManager;
    $count = intval($messageManager->countMessage()[0]);
    $limit = 5;
    $page = intval($_GET['page']);
    $nbPages = ceil($count / $limit);
    if ($page < 1 OR $page > $nbPages){
        $page = 1;
    }
    $offset = $limit * ($page - 1);
    $next = $page + 1;
    $previous = $page - 1;
    $listMessages = $messageManager->getListMessages($limit, $offset);
    require('views/mailbox.php');
}

//LECTURE DE MESSAGE
function readMessage()
{
    $messageManager = new Projet5\MessageManager;
    $messageManager->messageRead($_GET['id']);
    $message = $messageManager->getMessage($_GET['id']);
    require('views/read-mail.php');
}

//SUPPRIME UN MESSAGE
function deleteMessages()
{
    $messageManager = new Projet5\MessageManager;
    session_start();
    if(isset($_COOKIE['admin']) OR isset($_SESSION['admin']) AND !empty($_SESSION['admin'])){
        $messageManager->deleteMessage($_GET['id']);
        header('location:index.php?p=message&page=1');
    }
    else{
        header('location:index.php?p=login_page');
    }
}

// ---------------------------------------------LOG-----------------------------------------------
//LOGIN
function login()
{
    $logManager = new Projet5\LogManager;
    $error = "";
    $login = $logManager->checkpseudo($_POST['pseudo']);
    $isPasswordCorrect = password_verify($_POST['pass'], $login['password']);

    if (!$login){
        $error = "Mauvais identifiant ou mot de passe !";
        require('views/login.php');
    }
    else{
        if ($isPasswordCorrect){
            
            if (isset($_POST["remember"])){
                setcookie('admin', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
                header('location:index.php');
            }
            else{
                session_start();
                $_SESSION['admin'] = $_POST['pseudo'];
                header('location:index.php');
            }
        }
        else{
            $error = "Mauvais identifiant ou mot de passe !";
            require('views/login.php');
        }
    }
}

//LOGOUT
function logout()
{
    session_start();
    session_destroy();
    setcookie('admin', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
    header('location:index.php');
}

//PAGE LOGIN
function viewLogin()
{
    require('views/login.php');
}

//PAGE 404
function qcq()
{
    require('views/404.php');
}