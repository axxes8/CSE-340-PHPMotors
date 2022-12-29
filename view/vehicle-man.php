<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php/');
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Vehicle Management | PHP Motors</title>
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
                    //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
                    echo $navList;
                ?>
            </nav>

            <main id="page_main">
                <h1>Vehicle Management</h1>
                <?php if (isset($message)) {echo $message;} ?>

                <a href="index.php?action=addClassification">Add Classification</a><br>
                <a href="index.php?action=addVehicle">Add Vehicle</a><br>

                <?php 
                    if (isset($classificationList)){
                        echo '<h2>Vehicles By Classification</h2>';
                        echo '<p>Choose a classification to see those vehicles </p>';
                        echo $classificationList;
                    }
                ?>

                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use This Page</strong></p>
                </noscript>

                <table id="inventoryDisplay"></table>


            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>

        <script src="../js/inventory.js"></script>
    </body>
</html>

<?php unset($_SESSION['message']); ?>