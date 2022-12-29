<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Account Registration | PHP Motors</title>
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
                <h1>Register</h1>

                <?php
                    if (isset($message)) {
                     echo $message;
                    }
                ?>

                <form action="/phpmotors/accounts/index.php" method="post">
                    <div class="registration_form">
                        <label for="fname"><b>First Name</b></label>
                        <input id="fname" type="text" placeholder="Enter First Name" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>

                        <label for="lname"><b>Last Name</b></label>
                        <input id="lname" type="text" placeholder="Enter Last Name" name="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>

                        <label for="email"><b>Email</b></label>
                        <input id="email" type="email" placeholder="Enter Email" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>

                        <label for="password"><b>Password</b></label>
                        <p class="notice">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and one special character</p>
                        <input id="password" type="password" placeholder="Enter Password" name="clientPassword" required>
                            
                        <input type="submit" name="submit" id="regbtn" value="Register">
                        <input type="hidden" name="action" value="register">
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
    <?php unset($_SESSION['message']);?>