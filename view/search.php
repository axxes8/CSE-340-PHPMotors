<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Search | PHP Motors</title>
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
                <h1>Search</h1>

                <?php if(isset($message)){echo($message);} ?>

                <form class='searchForm' action="/phpmotors/search/" method='GET'>

                    <label for="searchForm">Search our database of vehicles<br></label>
                    <input required type="search" name="searchForm" id="searchForm" <?php if(isset($search)){echo("value ='$search'");}?>>
                   
                    <input type='submit' value='Search'>
                    <input type='hidden' name='action' value='search'>
                </form>

                <?php if(isset($searchList)){echo($searchList);}?>
                <?php if(isset($pageLink)&&($resultCount>10)){echo($pageLink);}?>
            </main>

            <footer id="page_footer">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php';
                ?>
            </footer>
        </div>
    </body>