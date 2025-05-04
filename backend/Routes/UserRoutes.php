<?php
require_once __DIR__ . '/../services/UserService.php';

$userService = new UserService();

// GET 
Flight::route('GET /users', function() use ($userService) {
    Flight::json($userService->getAll());
});

// GET 
Flight::route('GET /users/@id', function($id) use ($userService) {
    Flight::json($userService->getById($id));
});

// POST 
Flight::route('POST /users', function() use ($userService) {
    $data = Flight::request()->data->getData();
    Flight::json($userService->create($data));
});

// PUT 
Flight::route('PUT /users/@id', function($id) use ($userService) {
    $data = Flight::request()->data->getData();
    Flight::json($userService->update($id, $data));
});

// DELETE 
Flight::route('DELETE /users/@id', function($id) use ($userService) {
    Flight::json($userService->delete($id));
});

?>
