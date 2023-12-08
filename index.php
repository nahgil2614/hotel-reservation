<?php
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
#var_dump($uri);
$uri = explode('/', $uri);
if (isset($uri[1]) && $uri[1] === "api" && isset($uri[2])) {
    if (str_ends_with($uri[2], "user")) {
        $objUserController = new UserController();
        switch ($uri[2]) {
            case 'create-user':
                $result = $objUserController->apiCallHandler('POST', 'create');
                header("Location: /home");
                break;
            case 'get-user':
                $objUserController->apiCallHandler('GET', 'get');
                break;
            case 'verify-user':
                $result = $objUserController->apiCallHandler('POST', 'login');
                setcookie("user", json_encode($result->user), time() + (86400 * 30), "/");
                header("Location: /home");
                break;
            case 'log-out-user':
                setcookie("user", "", time() - 86400, "/");
                header("Location: /home");
                break;
            
            default:
                header("HTTP/1.1 404 Not Found");
                exit;
        }
    }
    elseif (str_ends_with($uri[2], "room")) {
        $objRoomController = new RoomController();
        switch ($uri[2]) {                
            case 'get-room':
                $result = $objRoomController->apiCallHandler('GET', 'get');
                break;
            case 'reserve-room':
                $objRoomController->apiCallHandler('POST', 'reserve');
                break;
            case 'cancel-room':
                $objRoomController->apiCallHandler('GET', 'cancel');
                break;
            
            default:
                header("HTTP/1.1 404 Not Found");
                exit;
        }
    }
}
//about-us|||sign-in|sign-up
elseif ($uri[1]) {
    $objPageController = new PageController();
    switch ($uri[1]) {
        case 'sign-in':
            $objPageController->requestHandler("signIn.php");
            break;
        case 'sign-up':
            $objPageController->requestHandler("signUp.php");
            break;

        case 'home':
        case 'about-us':
        case 'booking':
        case 'booking-info':
        case 'reservations':
            $objPageController->requestHandler("template.php");
            break;

        default:
            header("HTTP/1.1 404 Not Found");
            exit;
    }
}
else {
    header("Location: home");
}