<?php

    // Create or acccess a session
    session_start();
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
        case 'newsletter':
                include '..view/newsletter.php';
                break;

        case 'news':
            include '../view/newsletter.php';
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $existingEmail = checkExistingEmail($clientEmail);
            // Check for existing email address in the table
            if($existingEmail){
                $message = "<p class='alerta'>It looks like you have already signup. Look for it on your email.</p>";
                include '../view/home.php';
                exit;
            }
            // Validate email and password
            $clientEmail = checkEmail($clientEmail);
            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                $message = "<p class='alerta'>Please provide information for all empty form fields.</p>";
                include '../view/newsletter.php';
                exit; 
            }
            // Send the data to the model
            $regOutcome = regNews($clientFirstname, $clientLastname, $clientEmail);
            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $message = "<p class='alerta'>Thanks for registering $clientFirstname. You will now receive our emails.</p>";
                include '../view/home.php';
                exit;
            } else {
                $message = "<p class='alerta'>Sorry but the registration failed. Please try again.</p>";
                include '../view/newsletter.php';
                exit;
            }
            break;

        default:
            include '../view/newsletter.php';
            break;
    }
?>