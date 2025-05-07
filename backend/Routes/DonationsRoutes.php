<?php
require_once __DIR__ . '/../services/DonationsService.php';

$donationService = new DonationsService();


Flight::route('GET /donations', function() use ($donationService) {
    Flight::json($donationService->getAll());
});

Flight::route('GET /donations/@id', function($id) use ($donationService) {
    Flight::json($donationService->getById($id));
});


Flight::route('POST /donations', function() use ($donationService) {
    $data = Flight::request()->data->getData();
    Flight::json($donationService->create($data));
});


Flight::route('PUT /donations/@id', function($id) use ($donationService) {
    $data = Flight::request()->data->getData();
    Flight::json($donationService->update($id, $data));
});


Flight::route('DELETE /donations/@id', function($id) use ($donationService) {
    Flight::json($donationService->delete($id));
});
?>
