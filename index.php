<?php
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
#var_dump($uri);
$uri = explode('/', $uri);
if (isset($uri[1]) && $uri[1] === "api" && isset($uri[2])) {
    $objUserController = new UserController();
    $objRoomController = new RoomController();
    switch ($uri[2]) {
        case 'create-user':
            $objUserController->requestHandler('POST', 'create');
            break;
        case 'get-user':
            $objUserController->requestHandler('GET', 'get');
            break;
        case 'verify-user':
            $objUserController->requestHandler('POST', 'login');
            break;
            
        case 'get-room':
            $objRoomController->requestHandler('GET', 'get');
            break;
        case 'reserve-room':
            $objRoomController->requestHandler('POST', 'reserve');
            break;
        case 'cancel-room':
            $objRoomController->requestHandler('GET', 'cancel');
            break;
    }
}
else {
    header("HTTP/1.1 404 Not Found");
    exit;
}