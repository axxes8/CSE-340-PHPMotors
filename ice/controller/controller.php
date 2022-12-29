<?php
$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case "phpinfo":
            include '../view/phpinfo.php';
            break;
        case "bird":
            include '../view/bird.php';
            break;
        default:
            include '../view/404.php';
            break;
    }
?>