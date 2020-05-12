<?php

namespace App\Http\Controllers;

use App\Events\UserWasRegistered;
use App\Repostiories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCreateController extends Controller
{
    public function create(Request $request, UserRepositoryInterface $userRepository)
    {
        try {

            $data = $request->all();
            $data['password'] = Hash::make($request->get('password'));

            $user = new User($data);

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
