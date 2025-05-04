<?php
require_once __DIR__ . '/../services/PetitionsService.php';

$petitionsService = new PetitionsService();


Flight::route('GET /petitions', function() use ($petitionsService) {
    Flight::json($petitionsService->getAll());
});


Flight::route('GET /petitions/@id', function($id) use ($petitionsService) {
    Flight::json($petitionsService->getById($id));
});


Flight::route('POST /petitions', function() use ($petitionsService) {
    $data = Flight::request()->data->getData();
    Flight::json($petitionsService->create($data));
});

Flight::route('PUT /petitions/@id', function($id) use ($petitionsService) {
    $data = Flight::request()->data->getData();
    Flight::json($petitionsService->update($id, $data));
});


Flight::route('DELETE /petitions/@id', function($id) use ($petitionsService) {
    Flight::json($petitionsService->delete($id));
});
?>

