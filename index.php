<?php
require 'vendor/autoload.php'; 

require_once __DIR__ . '/backend/Services/UserService.php';


$userService = new UserService();


Flight::route('GET /users', function() use ($userService) {
    $users = $userService->getAll();
    Flight::json($users); 
});

Flight::route('GET /users/@id', function($id) use ($userService) {
    $user = $userService->getById($id);
    if ($user) {
        Flight::json($user); 
    } else {
        Flight::halt(404, 'User not found');
    }
});


Flight::route('POST /users', function() use ($userService) {
    $data = Flight::request()->data->getData();
    $newUser = $userService->create($data);
    Flight::json($newUser, 201); 
});

Flight::start();
?>
