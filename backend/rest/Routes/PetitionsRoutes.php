<?php
require_once __DIR__ . '/../services/PetitionsService.php';

$petitionsService = new PetitionsService();

/**
 * @OA\Get(
 *     path="/petitions",
 *     summary="Get all petitions",
 *     tags={"Petitions"},
 *     @OA\Response(
 *         response=200,
 *         description="List of petitions",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="Stop Deforestation"),
 *                 @OA\Property(property="description", type="string", example="Protect our local forests..."),
 *                 @OA\Property(property="created_by", type="integer", example=3),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-23 14:20:00")
 *             )
 *         )
 *     )
 * )
 */

Flight::route('GET /petitions', function()  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($petitionsService->getAll());
});

/**
 * @OA\Get(
 *     path="/petitions/{id}",
 *     summary="Get petition by ID",
 *     tags={"Petitions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the petition",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Petition data",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="Stop Deforestation"),
 *             @OA\Property(property="description", type="string", example="Protect our local forests..."),
 *             @OA\Property(property="created_by", type="integer", example=3),
 *             @OA\Property(property="created_at", type="string", example="2025-05-23 14:20:00")
 *         )
 *     )
 * )
 */

Flight::route('GET /petitions/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    Flight::json($petitionsService->getById($id));
});

/**
 * @OA\Post(
 *     path="/petitions",
 *     summary="Create a new petition",
 *     tags={"Petitions"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description", "created_by"},
 *             @OA\Property(property="title", type="string", example="Stop Deforestation"),
 *             @OA\Property(property="description", type="string", example="Protect our local forests from harmful industrial activities."),
 *             @OA\Property(property="created_by", type="integer", example=3)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Petition created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('POST /petitions', function()  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json($petitionsService->create($data));
});
/**
 * @OA\Put(
 *     path="/petitions/{id}",
 *     summary="Update a petition",
 *     tags={"Petitions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the petition to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string", example="Stop Logging"),
 *             @OA\Property(property="description", type="string", example="Logging in protected areas must end.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Petition updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('PUT /petitions/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json($petitionsService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/petitions/{id}",
 *     summary="Delete a petition",
 *     tags={"Petitions"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the petition to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Petition deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('DELETE /petitions/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($petitionsService->delete($id));
});
?>

