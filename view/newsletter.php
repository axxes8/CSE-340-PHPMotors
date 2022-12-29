<?php if (!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Newsletter | PHP Motors</title>
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
                <?php
                    if ($_SESSION['loggedin']){
                        $firstname = $_SESSION['clientData']['clientFirstname'];
                        $lastname = $_SESSION['clientData']['clientLastname'];
                        $email = $_SESSION['clientData']['clientEmail'];

                        echo $firstname, $lastname, $email;
                    }
                ?>
                <form action="/phpmotors/index.php" method="POST">
                    <label for="news_first">First Name:</label>
                    <input id="news_first" name="news_first" type="text" placeholder="First Name"><br><br>
                    <label for="news_last">Last Name:</label>
                    <input id="news_last" name="news_last" type="text" placeholder="Last Name"><br><br>
                    <label for="news_email">Email:</label>
                    <input id="news_email" name="news_email" type="email" placeholder="Email"><br><br>
                    <button type="submit">Submit</button>
                    <input type="hidden" name="action" value="news">
                </form>
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>