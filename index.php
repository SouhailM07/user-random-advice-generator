<?php 

require_once "vendor/autoload.php";
require_once "./src/models/dbh.model.php";
require_once "./src/models/auth.model.php";
require_once "./src/models/advice.model.php";
require_once "./src/controllers/advice.controller.php";
require_once "./src/controllers/auth.controller.php";
require_once "./src/routes/web.php";
require_once "./src/models/user.model.php";
require_once "./src/controllers/user.controller.php";

use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    definedRoutes($r);
});

$httpMethod= $_SERVER['REQUEST_METHOD'];
$uri= strtok($_SERVER["REQUEST_URI"],"?");
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 - page note found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "405- method not allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars=$routeInfo[2];
        if(is_callable($handler)){
            echo $handler($vars);
            break;
        }
}