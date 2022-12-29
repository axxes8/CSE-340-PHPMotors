<?php
    // Home Controller
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
    
    // Create or acccess a session
    session_start();
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
    }

    $classifications = getClassifications();

    $navList = navBar($classifications);

    // Check if the firstname cookie exists, get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    switch ($action) {
        case 'template':
            include 'view/template.php';
            break;
        
        default:
            include 'view/home.php';
            break;
    }
?>