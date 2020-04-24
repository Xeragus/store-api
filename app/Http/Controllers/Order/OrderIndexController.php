<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;

class OrderIndexController extends Controller
{
    public function index()
    {
        try {
            $user = User::where('email', 'john@doe.com')->first();

            $orders = Order::where('user_id', $user->id)->get()->all();

            return response()->json(['orders' => $orders]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
