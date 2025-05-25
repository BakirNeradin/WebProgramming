<?php
require_once '../vendor/autoload.php';

require_once __DIR__ . '/rest/Services/AuthService.php';
require_once __DIR__ . '/rest/Services/UserService.php';
require_once __DIR__ . '/rest/Services/DonationsService.php';
require_once __DIR__ . '/rest/Services/EventsService.php';
require_once __DIR__ . '/rest/Services/MessageService.php';
require_once __DIR__ . '/rest/Services/PetitionsService.php';
require_once __DIR__ . '/rest/Middleware/AuthMiddleware.php';


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Debug 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::register('auth_service', 'AuthService');
Flight::register('user_service', 'UserService');
Flight::register('donations_service', 'DonationsService');
Flight::register('events_service', 'EventsService');
Flight::register('message_service', 'MessageService');
Flight::register('petitions_service', 'PetitionsService');
Flight::register('auth_middleware', 'AuthMiddleware');


// Middleware
Flight::route('/*', function() {
    $path = Flight::request()->url;

    if (
        strpos($path, '/auth/login') === 0 ||
        strpos($path, '/auth/register') === 0
    ) {
        return true;
    }

    try {
        $token = Flight::request()->getHeader("Authentication");

        if (Flight::auth_middleware()->verifyToken($token)) {
            return TRUE;
        }



    } catch (Exception $e) {
        Flight::halt(401, 'Unauthorized: ' . $e->getMessage());
    }
});

require_once __DIR__ . '/rest/Routes/AuthRoutes.php';
require_once __DIR__ . '/rest/Routes/UserRoutes.php';
require_once __DIR__ . '/rest/Routes/DonationsRoutes.php';
require_once __DIR__ . '/rest/Routes/EventsRoutes.php';
require_once __DIR__ . '/rest/Routes/MessageRoutes.php';
require_once __DIR__ . '/rest/Routes/PetitionsRoutes.php';

Flight::start();
