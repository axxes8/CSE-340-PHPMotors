<?php
function regnewsletter($clientFirstname, $clientLastname, $clientEmail){
    $db = phpmotorsConnect(); // Create a Connection
    $sql = 'INSERT INTO newsletter (clientFirstname, clientLastname, clientEmail)
    VALUES (:clientFirstname, :clientLastname, :clientEmail)'; // define sql statement
    $stmt = $db->prepare($sql); //create prepare statement for connection
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR); // replace the placeholders in the SQL statement
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR); // with the actual values in the variables
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);        // tell the database the type of data it is
    $stmt->execute(); // insert data
    $rowsChanged = $stmt->rowCount(); // ask how many rows were changed
    $stmt->closeCursor(); // close the database interaction
    return $rowsChanged; // return the number of rows changed which shows the indication of success
}
?>