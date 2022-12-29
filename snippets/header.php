<img src='/phpmotors/images/site/logo.png' alt='PHP Motors logo' id='logo'>
<p><?php
    if (isset($_SESSION['loggedin'])){
        echo "<a class='header_btn' href='/phpmotors/accounts'>Welcome ".$_SESSION['clientData']['clientFirstname']."</a> |<a class='header_btn' href='/phpmotors/accounts/index.php?action=Logout'>Log Out</a> | <a href='/phpmotors/search/'><img id='search' src='/phpmotors/images/site/search.png' alt='PHP Motors Search'></a>";
    } else {
        echo "<a href='/phpmotors/accounts/?action=Login'>My Account</a> | <a href='/phpmotors/search/'><img id='search' src='/phpmotors/images/site/search.png' alt='PHP Motors Search'></a>";
    }
?></p>
