<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repostiories\Contracts\OrderRepositoryInterface;
use App\Repostiories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class OrdersController
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function addProduct(
        Request $request,
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository
    ) {
        try {
            $productId = (int)$request->get('product_id');
            $userId = (int)$request->get('user_id');
            $quantity = (float)$request->get('quantity');

            $user = $userRepository->get($userId);

            $order = $this->orderRepository->getByUser(
                $user,
                Order::STATE_CREATED
            );

            if (!$order) {
                $order = dispatch_now(new Order\CreateOrderCommand($user));

                $this->orderRepository->store($order);
            }

            $product = $productRepository->findOrFail($productId);

            dispatch_now(new Order\AddProductToOrderCommand($order, $product, $quantity));

            $this->orderRepository->store($order);

        } catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product successfully added.'
        ]);
    }

    public function removeProduct(
        Request $request,
        ProductRepositoryInterface $productRepository,
        UserRepositoryInterface $userRepository
    ) {
        try {
            $product = $productRepository->findOrFail((int)$request->get('product_id'));

            $user = $userRepository->get((int)$request->get('user_id'));

            $order = $this->orderRepository->getByUser(
                $user,
                Order::STATE_CREATED
            );

            if (!$order) {
                throw new \Exception('You don\'t have an order.');
            }

            $orderProduct = $order->getProduct($product);

            if (!$orderProduct) {
                throw new \Exception('Product not found in the order.');
            }

            $priceToBeRemoved = $orderProduct->getPrice() * $orderProduct->pivot->quantity;
            $order->setPrice($order->getPrice() - $priceToBeRemoved);

            $order->removeProduct($product);

            $this->orderRepository->store($order);

        } catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product successfully removed.'
        ]);
    }
}
