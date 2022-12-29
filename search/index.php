
<?php
    // Home Controller
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/search-model.php';
    
    // Create or acccess a session
    session_start();
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
    }

    $classifications = getClassifications();

    $navList = navBar($classifications);

    // Check if the firstname cookie exists, get its value
    if(isset($_COOKIE['firstname'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    switch ($action) {
        case 'search':
            $search = trim(filter_input(INPUT_GET, 'searchForm', FILTER_SANITIZE_STRING));
            $page = trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
            $search = str_ireplace(array('&lt;b&gt;', '&lt;/b&gt;', '&lt;h2&gt;', '&lt;/h2&gt;', '&QUOT;'), '', htmlspecialchars($search));
            // var_dump($search);
            if(empty($search)){
                $message = '<p class="message"> Please enter a search term into the field</p>';
                include '../view/search.php';
                exit;
            }

            $searchResult = vehSearch($search);
            // var_dump($searchResult);
            $resultCount = count($searchResult);

            if($resultCount < 1){
                $message = '<p class="notice"> No vehicles matched your search</p>';
            }
            else{

                $resultLimit = 10;
                if(isset($_GET['page'])){
                    $page = (int)$_GET['page'];
                }
                else{
                    $page = 1;
                };

                // var_dump($page);
                $start = ($page-1) * $resultLimit;
                // var_dump($start);
                $pageList = searchResultsPagination($search, $start, $resultLimit);

                $searchList = buildSearchResults($pageList, $resultCount);

                $pageLink = pagination($resultCount, $resultLimit, $search, $page);
            }

            include '../view/search.php';

            break;

        default:
            include '../view/search.php';
            break;
    }
?>