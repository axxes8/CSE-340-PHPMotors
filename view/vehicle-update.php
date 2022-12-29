<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php/');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	                elseif(isset($invMake) && isset($invModel)) { 
		                echo "Modify $invMake $invModel"; }?> | PHP Motors</title>

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
	                        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                        elseif(isset($invMake) && isset($invModel)) { 
	                        echo "Modify $invMake $invModel"; }?></h1>
                <div class="message">
                    <?php if (isset($message)) {echo $message;} ?>
                </div>

                <div class="veh_form">
                    <form action="/phpmotors/vehicles/index.php" method="post">

                        <label>Classification</label><br><br>
                        <?php 
                            echo $dropDown;
                        ?><br><br>
                        <label for="invMake">Make</label><br>
                        <input id="invMake" type="text" placeholder="Enter Make" name="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                        <label for="invModel">Model</label><br>
                        <input id="invModel" type="text" placeholder="Enter Model" name="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                        <label for="invDescription">Description</label><br><br>
                        <textarea name="invDescription" id="invDescription" placeholder="Enter Description" required>
                        <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br><br>
                        <label for="invImage">Image Path</label><br>
                        <input id="invImage" type="text" placeholder="Enter Image Path" name="invImage" required value='/images/no-image.png'><br>
                        <label for="invThumbnail">Thumbnail Path</label><br>
                        <input id="invThumbnail" type="text" placeholder="Enter Thumbnail Path" name="invThumbnail" required value='/images/no-image.png'><br>
                        <label for="invPrice">Price</label><br>
                        <input id="invPrice" type="text" placeholder="Enter Price" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>><br>
                        <label for="invStock">Stock</label><br>
                        <input id="invStock" type="text" placeholder="Enter Stock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}  elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>
                        <label for="invColor">Color</label><br>
                        <input id="invColor" type="text" placeholder="Enter Color" name="invColor" required  <?php if(isset($invColor)){echo "value='$invColor'";}  elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br>

                        <input type="submit" name="submit" id="vehbtn" value="Update Vehicle">
                        <input type="hidden" name="action" value="updateVehicle">
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