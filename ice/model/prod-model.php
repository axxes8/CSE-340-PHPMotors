<?php

    function addClassification($classificationName){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement to be used with the database 
        $sql = "insert into carclassification(classificationName) values (:classificationName)";
        // The next line creates the prepared statement using the phpmotors connection 
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        // The next line runs the prepared statement 
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // The next line closes the interaction with the database
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $ClassificationId){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement to be used with the database 
        $sql = 'INSERT INTO inventory(invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, ClassificationId)
            VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :ClassificationId)';
        // The next line creates the prepared statement using the phpmotors connection      
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

        // The next line runs the prepared statement 
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // The next line closes the interaction with the database
        $stmt->closeCursor();
        return $rowsChanged;

    }

?>