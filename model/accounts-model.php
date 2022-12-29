<?php
// Accounts Model

// Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }

function checkExistingEmail($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();

    if(empty($matchEmail)){
        return 0;
        // echo 'Nothing Found';
        // exit;
    }
    else{
        return 1;
        // echo 'Match Found';
        // exit;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
            FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

function getClientId($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
            FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

function updateClient($clientFirstName, $clientLastName, $clientEmail, $clientId){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    
    // The SQL statement to be used with the database 
    $sql = 'UPDATE clients SET clientFirstName = :clientFirstName, clientLastName = :clientLastName, clientEmail = :clientEmail WHERE clientId = :clientId';
    
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFirstName', $clientFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastName', $clientLastName, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    $_SESSION['clientData']['clientFirstname'] = $clientFirstName;
    $_SESSION['clientData']['clientLastname'] = $clientLastName;
    $_SESSION['clientData']['clientEmail'] = $clientEmail;
    // var_dump($_SESSION);
    // die;
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    return $rowsChanged;

}

function updatePassword($clientPassword, $clientId){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    
    // The SQL statement to be used with the database 
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    return $rowsChanged;

}

?>
