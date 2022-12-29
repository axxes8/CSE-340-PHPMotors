<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php/');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Add Classification | PHP Motors</title>
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
                <h1>Add Car Classification</h1>
                <div class="message">
                    <?php if (isset($message)) {echo $message;} ?>
                </div>
                <div class="class_form">
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <div class="class_form">
                            <label for="className"><b>Classification Name</b></label>
                            <p class="notice">Classifications must be no more than 30 characters in length</p>
                            <input id="className" type="text" placeholder="Enter Classification" name="classificationName" maxlength="30" required>    
                            <input type="submit" name="submit" id="classbtn" value="Add Classification">
                            <input type="hidden" name="action" value="addClassification">
                        </div>
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