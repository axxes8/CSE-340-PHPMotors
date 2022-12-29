<?php
    // Accounts Controller
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    $classifications = getClassifications();

    $navList = navBar($classifications);

    session_start();

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'register':
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Check for existing email
            $existingEmail = checkExistingEmail($clientEmail);

            if($existingEmail){
                $message = "<p class='message'>A user with that email aready exists. Please Login.</p>";
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                $message = "<p class='message'>Please provide information for all empty form fields.</p>";
                include '../view/registration.php';
                exit; 
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            
            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                header('Location: /phpmotors/accounts/index.php?action=login');
                exit;
            } else {
                $message = "<p class='notice'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;

        case 'registration':
            include '../view/registration.php';
            break;

        case 'Login':
            include '../view/login.php';
            break;
        
        case 'login':
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($clientEmail) || empty($checkPassword)){
                $_SESSION['message'] = "<p class='message'>Please provide information for all empty form fields.</p>";
                include '../view/login.php';
                exit; 
            }

            $clientData = getClient($clientEmail);
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

            if(!$hashCheck){
                $_SESSION['message'] = "<p class='message'>Please check your password and try again</p>";
                include '../view/login.php';
                exit;
            }

            $_SESSION['loggedin'] = TRUE;
            array_pop($clientData);

            $_SESSION['clientData'] = $clientData;
            include '../view/admin.php';
            exit;

            break;

        case 'Logout':
            $_SESSION['loggedin'] = FALSE;
            session_unset();
            session_destroy();
            header('Location: /phpmotors/accounts/index.php?action=Login');
            break;

        case 'updateAccount':
            include '../view/account-update.php';
            break;

        case 'updateInfo':
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
            $clientEmail = checkEmail($clientEmail);

            // Check for existing email
            $existingEmail = checkExistingEmail($clientEmail);

            if(!$_SESSION['clientData']['clientEmail'] == $clientEmail){
                if($existingEmail){
                    $message = "<p class='message'>A user with that email aready exists. Please try a different one.</p>";
                    include '../view/account-update.php';
                    exit;
                }
            }
            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)){
                $message = "<p class='message'>Please provide information for all empty form fields.</p>";
                var_dump($clientFirstname, $clientLastname, $clientEmail, $clientId);
                include '../view/account-update.php';
                exit; 
            }
            
            // Send the data to the model
            $updateClient = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
            
            $clientInfo = getClientId($clientId);
            array_pop($clientInfo);
            $_SESSION['clientInfo'] = $clientInfo;
            var_dump($clientInfo);

            // Check and report the result
            if($updateClient === 1){
                $_SESSION['message'] = "Information update was successful.";
                
                header('Location: /phpmotors/accounts/index.php');
                exit;
            } else {
                $message = "<p class='notice'>Information update failed. Please try again.</p>";
                header('Location: /phpmotors/accounts/index.php');
                exit;
            }
            break;

        case 'updatePassword':
            // Filter and store the data
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($clientPassword)){
                $message = "<p class='message'>Please provide information for all empty password fields.</p>";
                include '../view/account-update.php';
                exit; 
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send the data to the model
            $updatePassword = updatePassword($hashedPassword, $clientId);

            $clientInfo = getClientId($clientId);
            array_pop($clientInfo);
            $_SESSION['clientData'] = $clientInfo;

            // Check and report the result
            if($updatePassword === 1){
                $_SESSION['message'] = "Password update was successful.";
                include '../view/admin.php';
                exit;
            } else {
                $_SESSION['message'] = "Password update failed. Please try again";
                include '../view/admin.php';
                exit;
            }
            break;

        default:
            include '../view/admin.php';
            break;
    }

?>