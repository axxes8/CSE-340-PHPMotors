<?php
    // Vehicle Controller
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    $classifications = getClassifications();

    $navList = navBar($classifications);

    session_start();

    // drop down list
    $dropDown = '<select name="classificationId" id="classificationId">';
    $dropDown .= '<option>Choose a Classification</option>';
    foreach ($classifications as $classification){
        $dropDown .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
                $dropDown .= 'selected';
            }
        } elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
                $dropdown .= 'selected';
            }
        }
        $dropDown .= "> $classification[classificationName] </option>";
    }
    $dropDown .= '</select>';

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'addClassification':
            $newClassification = filter_input(INPUT_POST, 'classificationName');

            if(empty($newClassification)){
                $message = '<p> Please enter a new classification.</p>';
                include '../view/add-classification.php';
                exit;
            }

            $newClass = addClassification($newClassification);

            if($newClass === 1){
                $message = '<p>Classification added.</p>';
                include '../view/vehicle-man.php';
                exit;
            }

            else{
                $message = '<p>Classification registration failed.</p>';
                include '../view/add-classification.php';
                exit;
            }
        
        case 'addVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $ClassificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
                $message = '<p>Please enter data into all form fields</p>';
                include '../view/add-vehicle.php';
                break;
            }

            $addVehicle = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $ClassificationId);
        
            if($addVehicle === 1){
                $message = '<p>Vehicle added.</p>';
                header('location: /phpmotors/vehicles/');
                break;
            }

            else{
                $message = '<p>Vehicle registration failed.</p>';
                header('location: /phpmotors/vehicles/');
                break;
            }
        
        case 'getInventoryItems':
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $inventoryArray = getInventoryByClassification($classificationId);
            echo json_encode($inventoryArray);
            break;
        
        case 'mod':
            $vehId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($vehId);
            if(count($invInfo) < 1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-update.php';
            break;

        case 'updateVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $ClassificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
                $message = '<p>Please enter data into all form fields</p>';
                include '../view/vehicle-update.php';
                break;
            }

            $updateVehicle = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $ClassificationId, $invId);
        
            if($updateVehicle){
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                break;
            }

            else{
                $message = '<p>Vehicle update failed.</p>';
                header('location: /phpmotors/vehicles/');
                break;
            }

            break;
        
        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
		        $message = 'Sorry, no vehicle information could be found.';
	        }
	            include '../view/vehicle-delete.php';
	            exit;
            break;

        case 'deleteVehicle':
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            $deleteVehicle = deleteVehicle($invId);
        
            if($deleteVehicle){
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully deleteed.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                break;
            }

            else{
                $message = '<p>Vehicle deletion failed.</p>';
                header('location: /phpmotors/vehicles/');
                break;
            }

            break;

        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if(!count($vehicles)){
                $message = "<p class='notice'>Sorry, no $classificationName vehicles found</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            // echo $vehicleDisplay;
            // exit;
            include '../view/classification.php';
            break;

        case 'details':
            $vehId = filter_input(INPUT_GET, 'inventory', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehInfo = getInvItemInfo($vehId);
            
            if (empty($vehInfo)){
                $message = "<p class-'notice'> There was an error getting vehicle information</p>";
            }
            else {
                $vehDisplay = buildVehicleInfo($vehInfo);
            }
            // var_dump($vehInfo);
            include '../view/vehicle-detail.php';
            break;
        
        default:
            $classificationList = buildClassificationList($classifications);
            
            include '../view/vehicle-man.php';
            break;
    }

?>

