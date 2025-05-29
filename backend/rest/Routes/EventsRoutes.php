<?php
require_once __DIR__ . '/../services/EventsService.php';

$eventsService = new EventsService();

/**
 * @OA\Get(
 *     path="/events",
 *     summary="Get all events",
 *     tags={"Events"},
 *     @OA\Response(
 *         response=200,
 *         description="List of events",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="Youth Forum"),
 *                 @OA\Property(property="description", type="string", example="Annual gathering of youth leaders."),
 *                 @OA\Property(property="location", type="string", example="Sarajevo"),
 *                 @OA\Property(property="date", type="string", example="2025-06-15 10:00:00")
 *             )
 *         )
 *     )
 * )
 */

Flight::route('GET /events', function() use ($eventsService) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($eventsService->getAll());
});

/**
 * @OA\Get(
 *     path="/events/{id}",
 *     summary="Get specific event by ID",
 *     tags={"Events"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event details",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="Youth Forum"),
 *             @OA\Property(property="description", type="string", example="Annual gathering of youth leaders."),
 *             @OA\Property(property="location", type="string", example="Sarajevo"),
 *             @OA\Property(property="date", type="string", example="2025-06-15 10:00:00")
 *         )
 *     )
 * )
 */

Flight::route('GET /events/@id', function($id) use ($eventsService) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($eventsService->getById($id));
});

/**
 * @OA\Post(
 *     path="/events",
 *     summary="Create a new event",
 *     tags={"Events"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description", "location", "date"},
 *             @OA\Property(property="title", type="string", example="Youth Forum"),
 *             @OA\Property(property="description", type="string", example="Annual gathering of youth leaders."),
 *             @OA\Property(property="location", type="string", example="Sarajevo"),
 *             @OA\Property(property="date", type="string", example="2025-06-15 10:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event created",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('POST /events', function()  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json($eventsService->create($data));
});

/**
 * @OA\Put(
 *     path="/events/{id}",
 *     summary="Update an event",
 *     tags={"Events"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description", "location", "date"},
 *             @OA\Property(property="title", type="string", example="Updated Forum"),
 *             @OA\Property(property="description", type="string", example="Updated description"),
 *             @OA\Property(property="location", type="string", example="Mostar"),
 *             @OA\Property(property="date", type="string", example="2025-07-01 09:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('PUT /events/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json($eventsService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/events/{id}",
 *     summary="Delete an event",
 *     tags={"Events"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of event to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('DELETE /events/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($eventsService->delete($id));
});
?>
