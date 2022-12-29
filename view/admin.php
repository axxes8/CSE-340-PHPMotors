<?php if (!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Content Title | PHP Motors</title>
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
                <?php
                    if (isset($_SESSION['message'])) {
                     echo $_SESSION['message'];
                    }
                ?>
                <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>
                <p>You are logged in</p>
                <ul>
                    <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']?></li>
                    <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname']?></li>
                    <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']?></li>
                </ul>

                <h2>Account Managment</h2>
                <p>Use this link to update account Information</p>
                <a href="../accounts/index.php?action=updateAccount">Update Account Information</a>
                
                
                <?php
                if (intval($_SESSION['clientData']['clientLevel']) > 1){
                    echo '<h2>Inventory Management</h2>';
                    echo '<p>Use this link to manage the inventory</p>';
                    echo "<a href='../vehicles/'>Vehicle Management</a>";
                }
                ?>
                
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>
    <?php unset($_SESSION['message']);?>