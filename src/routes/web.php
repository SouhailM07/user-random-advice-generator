<?php

use FastRoute\RouteCollector;

function definedRoutes(RouteCollector $r){
    $r->get('/', function () {
        header('location: /login');
    });
    $r->get('/login', function () {
        include(__DIR__.'/../views/login.view.php');
    });
    $r->get('/register', function () {
        include(__DIR__.'/../views/register.view.php');
    });
        $r->get('/home', function () {
        include(__DIR__.'/../views/home.view.php');
    });
    $r->get('/advices', function () {
        include(__DIR__.'/../views/advices.view.php');
    });
    $r->post("/advices/update",function(){
        $newAdvice = $_POST['newAdvice'] ?? '';
        $id = $_POST['id'] ?? null; 
        if($newAdvice && $id){
            $adviceController = new AdviceController();
            $adviceController->handle_updateAdvice( $id,$newAdvice);
            // * redirect to the advices page after creation
            header('Location: /advices'); 
        } else {
            echo "Error: Invalid input. ";
            echo "$id, $newAdvice";
        }
    });
    $r->post('/advices', function () {
        // * handle advice creation logic here
        $advice = $_POST['advice'] ?? '';
        $userId = $_POST['userId'] ?? null; 
        if ($advice && $userId) {
            $adviceController = new AdviceController();
            $adviceController->handle_createAdvice( $advice,$userId);
            // * redirect to the advices page after creation
            header('Location: /advices'); 
        } else {
            echo "Error: Invalid input. ";
            echo "$advice, $userId";
        }

    });
    $r->post('/register', function () {
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        $authController = new MyAuthController();
        $authController->registerUser($name, $password, $confirmPassword);
    });
    $r->post('/login', function () {
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $authController = new MyAuthController();
        $authController->loginUser($name, $password);
    });
    $r->post('/advices/delete', function () {
        $id= $_POST['id'] ?? null;
        $adviceController = new AdviceController();
        $response = $adviceController->handle_deleteAdvice( $id);
        if ($response['status'] === 200) {
            header('Location: /advices');
        } else {
            echo "Error: " . $response['message'];
        }
    });
    $r->get('/logout', function () {
        session_start();
        session_destroy();
        header('Location: /login');
    });
}