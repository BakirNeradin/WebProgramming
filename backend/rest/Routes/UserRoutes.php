<?php
 require_once __DIR__ . '/../Services/UserService.php';

$userService = new UserService();
 
// GET 
/**
 * @OA\Get(
 *     path="/users",
 *     summary="Get all users",
 *     tags={"Users"},
 *     @OA\Response(
 *         response=200,
 *         description="List of users",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="John Doe"),
 *                 @OA\Property(property="email", type="string", example="john@example.com")
 *             )
 *         )
 *     )
 * )
 */
Flight::route('GET /users', function()  {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::userService()->getAll());
});

/**
 * @OA\Get(
 *      path="/users/{id}",
 *      tags={"users"},
 *      summary="Fetch individual user by ID from path.",
 *      security={
 *          {"APIKey":{}}
 *      },
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="User ID.",
 *          @OA\Schema(type="integer"),
 *          example=1
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Fetch individual user."
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad request - missing or invalid ID."
 *      )
 * )
 */
Flight::route('GET /users/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::VOTER, Roles::ADMIN]);
    $user = Flight::get('user');
    if($user->role === Roles::ADMIN || $user->role === Roles::VOTER){
        Flight::json(Flight::user_service()->get_by_id($id));
    }
});


/**
 * @OA\Post(
 *     path="/users",
 *     summary="Add a new user.",
 *     description="Add a new user to the database.",
 *     tags={"users"},
 *     security={
 *         {"ApiKey": {}}
 *     },
 *     @OA\RequestBody(
 *         description="Add new user",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"name", "email", "password"},
 *             
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                     example="My name",
 *                     description="User name"
 *                 ),
 *                 @OA\Property(
 *                      property="email",
 *                      type="string",
 *                      example="email@gmail.com",
 *                      description="User email"
 *                  ),
 *      
 *                  @OA\Property(
 *                      property="password",
 *                      type="string",
 *                      example="ascomplicatedaspossible123",
 *                      description="User password"
 *                  )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User has been added."
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error."
 *     )
 * )
 */
Flight::route('POST /users', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::VOTER, Roles::ADMIN]);
    $user = Flight::get('user');
    if($user->role === Roles::ADMIN){
        $request = Flight::request()->data->getData();
        if (isset($request['password'])) {
            $request['password'] = password_hash($request['password'], PASSWORD_BCRYPT);
        }
        Flight::json([
            'message'=>"User has been added!",
            'data'=>Flight::user_service()->add($request)
        ]);
    }
    else{
        Flight::json(['message'=>"Only admins have the permission for this operation!"]);
    }
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     summary="Update a user",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="Jane Doe"),
 *             @OA\Property(property="email", type="string", example="jane@example.com"),
 *             @OA\Property(property="password", type="string", example="newpassword123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */

Flight::route('PUT /users/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    Flight::json($userService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     summary="Delete a user",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success")
 *         )
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function($id)  {
    Flight::auth_middleware()->authorizeRole([Roles::ADMIN, Roles::USER]);
    Flight::json($userService->delete($id));
});

?>


