<?php

namespace App\Models\QueryRepositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class UserRepository
{
    // Register a new Driver
    public function registerDriver($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRole::DRIVER->value,
            'password' => Hash::make($data['password']),
        ]);
    }

    // Login user
    public function login($credentionals)
    {
        if (Auth::attempt($credentionals)) {
            $user = Auth::user();
            return $user;
        }
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function listDrivers()
    {
        return User::where('role', UserRole::DRIVER->value)->get();
    }
}
