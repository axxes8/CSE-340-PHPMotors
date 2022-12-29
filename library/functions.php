<?php
    function checkEmail($clientEmail){
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    function checkPassword($clientPassword){
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    function navBar($classifications){
        $navList = '<ul>';
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    function buildClassificationList($classifications){ 
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
         $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
    }

    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle){
            $price = '$' .number_format("$vehicle[invPrice]", 2, '.', ',');
            $dv .= '<li>';
            $dv .= "<a href='/phpmotors/vehicles/index.php?action=details&inventory=$vehicle[invId]'>";
            $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
            $dv .= '<hr>';
            $dv .= "<a href='/phpmotors/vehicles/index.php?action=details&inventory=$vehicle[invId]'>";
            $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
            $dv .= "<span> $price </span>";
            $dv .= '</li>';
        }
        $dv.='</ul>';
        return $dv;
    }

    function buildVehicleInfo($vehInfo){
        $price = '$' .number_format("$vehInfo[invPrice]", 2, '.', ',');
        $dv = "<section class='veh-info'>";
        $dv .= "<img src='$vehInfo[imgPath]' alt='$vehInfo[invMake] $vehInfo[invModel]'>";
        $dv .= "<div id='veh-details'><h2>Price: $price</h2>";
        $dv .= "<h2>$vehInfo[invMake] $vehInfo[invModel] Details</h2>";
        $dv .= "<p>$vehInfo[invDescription]</p>";
        $dv .= "<p>Color: $vehInfo[invColor]</p>";
        // $dv .= "<p>Ammount in stock: $vehInfo[invStock]</p>";
        $dv .= "</div></section>";

        return $dv;
    }

    function buildSearchResults($results, $resultCount){
        $dv = '<div class="search">';
        $dv .= "<p class='count'>$resultCount results found</p>";
        foreach ($results as $result){
            $dv .= "<a class='searchLink' href='/phpmotors/vehicles/?action=details&inventory=$result[invId]'><h2>$result[invYear] $result[invMake] $result[invModel]</h2></a>";
            $dv .= "<div class='searchDesc'><p>$result[invDescription]</p></div>";
        }
        $dv .= "</div>";
        return $dv;
    }

    function pagination($resultCount, $resultLimit, $search, $pageNum){
        // echo("ran pagination func");
        $totalPages = ceil($resultCount / $resultLimit);
        $dv = "<ul class='pagination'>";
        if($pageNum > 1){
            $dv .= "<li class='pageNum'><a class='pageNumLink' href='/phpmotors/search/?action=search&searchForm=$search&page=" . $pageNum - 1 . "'> <h2> << </h2></a></li>";
        }
        for($pages=1; $pages<=$totalPages; $pages++){
            $dv .= "<li class='pageNum'>";

            
            if($pages == $pageNum){
                $dv .= "<a class='active'> <h2> $pages </h2> </a></li>";
            }
            else{
                $dv.= "<a class='pageNumLink' href='/phpmotors/search/?action=search&searchForm=$search&page=$pages'> <h2> $pages </h2></a></li>";
            }
            
            
        }
        if($pageNum < $totalPages){
            $dv .= "<li class='pageNum'><a class='pageNumLink' href='/phpmotors/search/?action=search&searchForm=$search&page=" . $pageNum + 1 . "'> <h2> >> </h2></a></li>";
        }
        $dv .= "</ul>";
        return $dv;

    }
?>