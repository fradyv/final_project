<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with(['campaign:id,title', 'items.product:id,title'])
            ->latest('created_at')
            ->paginate(15);

        if ($request->expectsJson()) {
            return response()->json($orders);
        }

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id && ! $request->user()->hasRole('admin')) {
            abort(403);
        }

        $order->load(['campaign.fundraiser.user:id,name', 'items.product.shop', 'paymentMethod']);

        if ($request->expectsJson()) {
            return response()->json(['order' => $order]);
        }

        return view('orders.show', compact('order'));
    }
}
