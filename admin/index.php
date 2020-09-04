<!-- ROOTER BACKEND -->
<?php
require('../controller/controllerBackend.php');

if (!isset($_GET['p'])):
    home();
else:
    switch ($_GET['p']):

        case "list":
            articlesList();
        break;

        case "view_create":
            require('views/create.php');
        break;

        case "create":
            create();
        break;

        case "message":
            messagesList();
        break;

        case "read_message":
            readMessage();
        break;

        case "view_edit":
            viewEdit();
        break;

        case "edit":
            edit();
        break;

        case "delete_post":
            deletePosts();
        break;

        case "valid_comment":
            validComments();
        break;

        case "delete_message":
            deleteMessages();
        break;

        case "delete_comment":
            deleteComments();
        break;

        case "comment":
            comment();
        break;

        case "read_comment":
            readComment();
        break;

        case "login_page":
            require('views/login.php');
        break;

        case "login":
            login();
        break;

        case "logout":
            logout();
        break;

        default:
            require('views/404.php');
        
    endswitch;
endif;