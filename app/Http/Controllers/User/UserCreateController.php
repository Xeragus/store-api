<?php

namespace App\Http\Controllers;

use App\Events\UserWasRegistered;
use App\Repostiories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class UserCreateController extends Controller
{
    public function create(Request $request, UserRepositoryInterface $userRepository)
    {
        try {
            $user = new User($request->all());

            $userRepository->store($user);

            event(new UserWasRegistered($user));

            return response()->json([
                'error' => false,
                'message' => 'New user is registered with id #' . $user->id,
                'item' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
