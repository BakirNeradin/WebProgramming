<?php
require_once __DIR__ . '/../services/MessagesService.php';

$messagesService = new MessagesService();


Flight::route('GET /messages', function() use ($messagesService) {
    Flight::json($messagesService->getAll());
});


Flight::route('GET /messages/@id', function($id) use ($messagesService) {
    Flight::json($messagesService->getById($id));
});


Flight::route('POST /messages', function() use ($messagesService) {
    $data = Flight::request()->data->getData();
    Flight::json($messagesService->create($data));
});


Flight::route('PUT /messages/@id', function($id) use ($messagesService) {
    $data = Flight::request()->data->getData();
    Flight::json($messagesService->update($id, $data));
});

Flight::route('DELETE /messages/@id', function($id) use ($messagesService) {
    Flight::json($messagesService->delete($id));
});
?>
