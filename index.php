<!-- ROOTER FRONTEND -->
<?php
require('controller/controllerFrontend.php');

if (!isset($_GET['p'])):
    home();
else:

    switch ($_GET['p']):

        case "post":
            post();
        break;

        case "form":
            form();
        break;

        case "contact":
            require("views/contact.php");
        break;

        case "news":
            news();
        break;

        case "comment":
            comment();
        break;

        case "report":
            report();
        break;

        default:
            require('views/404.php');
        
    endswitch;
endif;