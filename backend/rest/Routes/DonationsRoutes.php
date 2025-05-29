<?php

$donationService = new DonationsService();

/**
 * @OA\Get(
 *     path="/donations",
 *     summary="Get all donations",
 *     tags={"Donations"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all donations",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=4),
 *                 @OA\Property(property="amount", type="number", format="float", example=50.00),
 *                 @OA\Property(property="message", type="string", example="Supporting your cause"),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-23 14:30:00")
 *             )
 *         )
 *     )
 * )
 */

Flight::route('GET /donations', function()  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($donationService->getAll());
});
/**
 * @OA\Get(
 *     path="/donations/{id}",
 *     summary="Get specific donation by ID",
 *     tags={"Donations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Donation ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Donation details",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=4),
 *             @OA\Property(property="amount", type="number", format="float", example=50.00),
 *             @OA\Property(property="message", type="string", example="Keep it up!"),
 *             @OA\Property(property="created_at", type="string", example="2025-05-23 14:30:00")
 *         )
 *     )
 * )
 */

Flight::route('GET /donations/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($donationService->getById($id));
});

/**
 * @OA\Post(
 *     path="/donations",
 *     summary="Create a new donation",
 *     tags={"Donations"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "amount"},
 *             @OA\Property(property="user_id", type="integer", example=4),
 *             @OA\Property(property="amount", type="number", format="float", example=100.00),
 *             @OA\Property(property="message", type="string", example="For the youth initiatives")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Donation created",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('POST /donations', function()  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json($donationService->create($data));
});

/**
 * @OA\Put(
 *     path="/donations/{id}",
 *     summary="Update donation",
 *     tags={"Donations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of donation to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="amount", type="number", format="float", example=150.00),
 *             @OA\Property(property="message", type="string", example="Updated message")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Donation updated",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('PUT /donations/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json($donationService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/donations/{id}",
 *     summary="Delete a donation",
 *     tags={"Donations"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Donation ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Donation deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('DELETE /donations/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($donationService->delete($id));
});
?>
