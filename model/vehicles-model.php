<?php

    function addClassification($classificationName){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement to be used with the database 
        $sql = "INSERT INTO carclassification(classificationName) VALUES (:classificationName)";
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

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement to be used with the database 
        $sql = 'INSERT INTO inventory(invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
                     VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
        // The next line creates the prepared statement using the phpmotors connection      
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        // $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        // $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindvalue(':imgName', $imgName, PDO::PARAM_STR);
        $stmt->bindvalue(':imgPath', $imgPath, PDO::PARAM_STR);
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

    function getInventoryByClassification($classificationId){ 
        $db = phpmotorsConnect(); 
        $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
        $stmt->execute(); 
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $inventory; 
    }

    function getInvItemInfo($invId){
        $db = phpmotorsConnect();
        // $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $sql = "SELECT * FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId AND images.imgPath NOT LIKE '%-tn.jpg'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        
        // The SQL statement to be used with the database 
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';                   
        
        // The next line creates the prepared statement using the phpmotors connection      
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        // $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        // $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindvalue(':imgName', $imgName, PDO::PARAM_STR);
        $stmt->bindvalue(':imgPath', $imgPath, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // The next line runs the prepared statement 
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // The next line closes the interaction with the database
        $stmt->closeCursor();
        return $rowsChanged;

    }

    function deleteVehicle($invId){
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();
        
        // The SQL statement to be used with the database 
        $sql = 'DELETE FROM inventory WHERE invId = :invId';                   
        
        // The next line creates the prepared statement using the phpmotors connection      
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // The next line runs the prepared statement 
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        // The next line closes the interaction with the database
        $stmt->closeCursor();
        return $rowsChanged;

    }

    function getVehiclesByClassification($classificationName){
        $db = phpmotorsConnect();
        $sql = "SELECT * FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND images.imgPath LIKE '%-tn.jpg'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    }
?>