<!-- ROOTER FRONTEND -->
<?php
require('controller/controllerFrontend.php');

if (!isset($_GET['p'])){
    home();
}
else{

    switch ($_GET['p']){

        case "post":
            post();
        break;

        case "form":
            form();
        break;

        case "contact":
            contact();
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
            qcq();
    }  
}