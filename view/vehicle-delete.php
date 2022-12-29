<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php/');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		                echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	                elseif(isset($invMake) && isset($invModel)) { 
		                echo "Delete $invMake $invModel"; }?> | PHP Motors</title>

        <link rel='stylesheet' type='text/css' href='/phpmotors/css/style.css' media='screen'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <div class='content'>
            <header id="page_header">
                 <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
                ?>
            </header>

            <nav id="page_nav">
                <?php
                    echo $navList;
                ?>
            </nav>

            <main id="page_main">
                <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
                        elseif(isset($invMake) && isset($invModel)) { 
	                        echo "Delete $invMake $invModel"; }?></h1>
                <div class="message">
                    <?php if (isset($message)) {echo $message;} ?>
                </div>
                <p>Confirm Vehicle Deletion. The delete is permanent.</p>

                <div class="veh_form">
                    <form action="/phpmotors/vehicles/index.php" method="post">

                        <label for="invMake">Make</label><br>
                        <input id="invMake" type="text" placeholder="Enter Make" name="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                        <label for="invModel">Model</label><br>
                        <input id="invModel" type="text" placeholder="Enter Model" name="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                        <label for="invDescription">Description</label><br><br>
                        <textarea name="invDescription" id="invDescription" placeholder="Enter Description" readonly>
                        <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br><br>

                        <input type="submit" name="submit" id="vehbtn" value="Delete Vehicle">
                        <input type="hidden" name="action" value="deleteVehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">

                    </form>
                </div>
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>
    <?php unset($_SESSION['message']);?>