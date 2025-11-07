<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryRepositories\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = $this->userRepo->login($credentials);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'You are now Logged in'
        ], Response::HTTP_OK);
    }



    public function listDrivers()
    {
        return $this->userRepo->listDrivers();
    }
}
