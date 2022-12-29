<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Account Login | PHP Motors</title>
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
                <h1>Sign In</h1>

                <?php
                    if (isset($_SESSION['message'])) {
                     echo $_SESSION['message'];
                    }
                ?>
                
                <form action="/phpmotors/accounts/" method="post">

                    <div class="login_form">
                        <label for="email"><b>Email</b></label>
                        <input id="email" type="email" placeholder="Enter Email" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>

                        <label for="password"><b>Password</b></label>
                        <input id="password" type="password" placeholder="Enter Password" name="clientPassword" required>
                            
                        <input type="submit" name="submit" id="subBtn" value="Sign-In">
                        <input type="hidden" name="action" value="login">

                        <p>No Account? <a href="index.php?action=registration">Register Here</a></p>
                    </div>
                </form>
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']);?>