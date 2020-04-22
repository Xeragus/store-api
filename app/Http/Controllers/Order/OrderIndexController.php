<?php
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Exception;

class OrdersController extends Controller
{
    
    public function index()
    {
        try {
            $user = User::where('email', 'john@doe.com')->first();

            $orders = Order::where('user_id', $user->id)->get()->all();

            return response()->json(['orders' => $orders]);

        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}