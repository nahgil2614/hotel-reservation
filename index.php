<?php
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
// var_dump($uri);
if ((isset($uri[3]))) {
    $objFeedController = new UserController();
    if ($uri[3] == 'get-user' || $uri[3] == 'create-user') {
        $objFeedController->requestHandler();
    } elseif ($uri[3] == 'verify-user') {
        $objFeedController->loginHandler();
    }
} 
// if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }
// require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
// $objFeedController = new UserController();
// $strMethodName = $uri[3] . 'Action';
// $objFeedController->{$strMethodName}();
