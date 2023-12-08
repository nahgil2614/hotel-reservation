<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the controller & model files
spl_autoload_register(function ($className) {
	if ($className == "RoomController" || $className == "UserController") {
		require PROJECT_ROOT_PATH . "/Controller/Api/" . $className . '.php';
	}
	elseif (str_ends_with($className, "Controller")) {
		require PROJECT_ROOT_PATH . "/Controller/" . $className . '.php';
	}
    elseif (str_ends_with($className, "Model")) {
		require PROJECT_ROOT_PATH . "/Model/" . $className . ".php";
	}
});