<?php
require_once __DIR__ . '/../services/EventsService.php';

$eventsService = new EventsService();

Flight::route('GET /events', function() use ($eventsService) {
    Flight::json($eventsService->getAll());
});


Flight::route('GET /events/@id', function($id) use ($eventsService) {
    Flight::json($eventsService->getById($id));
});


Flight::route('POST /events', function() use ($eventsService) {
    $data = Flight::request()->data->getData();
    Flight::json($eventsService->create($data));
});


Flight::route('PUT /events/@id', function($id) use ($eventsService) {
    $data = Flight::request()->data->getData();
    Flight::json($eventsService->update($id, $data));
});


Flight::route('DELETE /events/@id', function($id) use ($eventsService) {
    Flight::json($eventsService->delete($id));
});
?>
