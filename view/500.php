<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>500 | PHP Motors</title>
        <link rel='stylesheet' type='text/css' href='/phpmotors/css/style.css' media='screen'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
        <div class='content'>
            <header id="page_header">
            <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'
                ?>
            </header>

            <nav id="page_nav">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'
                ?>
            </nav>

            <main id="page_main">
                <h1>Server Error</h1>
                <p>Sorry our server seems to be experienchng some technical difficulties.</p>
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'
                ?>
            </footer>
        </div>
    </body>