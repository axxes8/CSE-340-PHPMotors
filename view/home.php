<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Home | PHP Motors</title>
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
                    if (isset($_SESSION['loggedin'])){
                        echo "<a href='/phpmotors/newsletter/index.php?action=news'>Newsletter</a>";
                    } else {
                        echo "<a href='/phpmotors/newsletter/index.php?action=news'>Newsletter</a>";
                    }
                ?>
                <h1>Welcome to PHP Motors!</h1>
                <div class='main-content'>
                    
                    <div class='features'>    
                        <h2>DMC Delorean</h2>
                        <p>3 Cup Holders</p>
                        <p>Superman Doors</p>
                        <p>Fuzzy Dice!</p>
                        <img src='/phpmotors/images/site/own_today.png' alt='own today'>
                    </div>
                    <img src='/phpmotors/images/vehicles/delorean.jpg' alt='delorean' id='delorean'>
                </div>
                <div class='alt-content'>                  
                    <div class='upgrades'>
                        <h3>Delorean Upgrades</h3>
                        <div class='upgrade-content'>
                            <div>
                                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                                <p>Flux Capacitor</p>
                            </div>
                            <div>
                                <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decal">
                                <p>Flame Decals</p>
                            </div>
                            <div>
                                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
                                <p>Bumper Stickers</p>
                            </div>
                            <div>
                                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Cap">
                                <p>Hub Caps</p>
                            </div>
                        </div>
                    </div>

                    <div class='reviews'>
                            <h3>DMC Delorean Reviews</h3>
                            <ul>
                                <li>"So fast its almost like traveling in time." (4/5)</li>
                                <li>"Coolest ride on the road." (4/5)</li>
                                <li>"I'm feeling Marty McFly!" (5/5)</li>
                                <li>"The most futuristic ride of our day." (4.5/5)</li>
                                <li>"80's livin and I love it!" (5/5)</li>
                            </ul>
                    </div>
                    
                </div>
            </main>
    
            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>
</html>