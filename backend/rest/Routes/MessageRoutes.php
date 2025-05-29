<?php
 require_once __DIR__ . '/../Services/MessageService.php';

$messagesService = new MessagesService();

/**
 * @OA\Get(
 *     path="/messages",
 *     summary="Get all messages",
 *     tags={"Messages"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all messages",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="user_id", type="integer", example=2),
 *                 @OA\Property(property="subject", type="string", example="Help with login"),
 *                 @OA\Property(property="message", type="string", example="I'm having trouble accessing my account."),
 *                 @OA\Property(property="created_at", type="string", example="2025-05-22 12:34:56")
 *             )
 *         )
 *     )
 * )
 */

Flight::route('GET /messages', function()  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($messagesService->getAll());
});

/**
 * @OA\Get(
 *     path="/messages/{id}",
 *     summary="Get a specific message by ID",
 *     tags={"Messages"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the message",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message found",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="subject", type="string", example="Help with login"),
 *             @OA\Property(property="message", type="string", example="I'm having trouble accessing my account."),
 *             @OA\Property(property="created_at", type="string", example="2025-05-22 12:34:56")
 *         )
 *     )
 * )
 */

Flight::route('GET /messages/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($messagesService->getById($id));
});

/**
 * @OA\Post(
 *     path="/messages",
 *     summary="Create a new message",
 *     tags={"Messages"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "subject", "message"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="subject", type="string", example="Help with login"),
 *             @OA\Property(property="message", type="string", example="I'm having trouble accessing my account.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message created",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('POST /messages', function()  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json($messagesService->create($data));
});

/**
 * @OA\Put(
 *     path="/messages/{id}",
 *     summary="Update an existing message",
 *     tags={"Messages"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the message to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"subject", "message"},
 *             @OA\Property(property="subject", type="string", example="Updated Subject"),
 *             @OA\Property(property="message", type="string", example="Updated message content.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('PUT /messages/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json($messagesService->update($id, $data));
});
/**
 * @OA\Delete(
 *     path="/messages/{id}",
 *     summary="Delete a message",
 *     tags={"Messages"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the message to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Message deleted",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('DELETE /messages/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($messagesService->delete($id));
});
?>
