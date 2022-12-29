<?php
    function vehSearch($search){
        $db = phpmotorsconnect();

        $sql = "SELECT * FROM inventory WHERE invColor LIKE :search OR invMake LIKE :search or invModel LIKE :search OR invDescription LIKE :search";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    function searchResultsPagination($search, $start, $resultLimit){
        // echo("ran searchResultsPagination func");
        // var_dump($start, $resultLimit);
        $db = phpmotorsconnect();

        $sql = "SELECT * FROM inventory WHERE invColor LIKE :search OR invMake LIKE :search or invModel LIKE :search OR invDescription LIKE :search LIMIT :startValue, :resultLimit";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue('startValue', $start, PDO::PARAM_INT);
        $stmt->bindValue('resultLimit', $resultLimit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
?>
