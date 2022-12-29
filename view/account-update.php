<?php if (!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Manage Account | PHP Motors</title>
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
                <h1>Manage Account</h1>

                <?php
                    if (isset($message)) {
                     echo $message;
                    }
                ?>

                <h2>Update Account</h2>

                <form action="/phpmotors/accounts/index.php" method="post">

                    <label for="firstName">First Name</label><br>
                    <input id="firstName" type="text" placeholder="Enter First Name" name="clientFirstname" required <?php if(isset($firstName)){echo "value='$clientFirstName'";} elseif(isset($_SESSION['clientData']['clientFirstname'])){echo "value='".$_SESSION['clientData']['clientFirstname']."'";} ?>><br>
                    
                    <label for="lastName">Last Name</label><br>
                    <input id="lastName" type="text" placeholder="Enter Last Name" name="clientLastname" required <?php if(isset($lastName)){echo "value='$clientLastName'";} elseif(isset($_SESSION['clientData']['clientLastname'])){echo "value='".$_SESSION['clientData']['clientLastname']."'";} ?>><br>
                                         
                    <label for="email">Email</label><br>
                    <input id="email" type="text" placeholder="Enter Email" name="clientEmail" required <?php if(isset($email)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])){echo "value='".$_SESSION['clientData']['clientEmail']."'";} ?>><br>
                                             
                    
                    <input type="submit" name="submit" id="accbtn" value="Update Information">
                    <input type="hidden" name="action" value="updateInfo">
                    <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">

                </form>

                <h2>Update Password</h2>
                <p class="notice">Passwords must be at least 8 characters, contain 1 number, 1 capital letter, and 1 special character.</p>
                <p class="notice">*NOTE: Your password will be changed</p>

                <form action="/phpmotors/accounts/index.php" method="post">

                    <label for="password">New Password</label><br>
                    <input id="password" type="password" placeholder="Enter New Password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    
                    <input type="submit" name="submit" id="passbtn" value="Update Password">
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">

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