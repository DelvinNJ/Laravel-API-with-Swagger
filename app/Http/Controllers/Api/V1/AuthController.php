<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\V1\UserLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\POST(
     *      path="/api/v1/login",
     *      tags={"User"},
     *      operationId="userLogin", 
     *      summary="Login user", 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"email", "password"},
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="User email"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="User password"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation", 
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function login(UserLoginRequest $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'incorrect username or password'
            ], 401);
        }

        $admin_token = $user->createToken('api-token', ['read', 'create', 'update', 'delete']);
        $customer_token = $user->createToken('api-token', ['read', 'create', 'update']);
        $basic_token = $user->createToken('api-token', ['read']);

        $tokens = [
            'admin_token' => $admin_token->plainTextToken,
            'customer_token' => $customer_token->plainTextToken,
            'basic_token' => $basic_token->plainTextToken
        ];

        return response($tokens, 201);
    }
    /**
     * @OA\POST(
     *      path="/api/v1/logout",
     *      tags={"User"},
     *      operationId="userLogout", 
     *      summary="Logout user", 
     *      @OA\Response(
     *          response=200, 
     *          description="Successful operation", 
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'user logged out'
        ], 200);
    }
}
