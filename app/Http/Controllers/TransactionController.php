<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Models\DigitalProduct;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Buyer purchases a digital product. On success, the amount is credited
     * to the seller's wallet (their sale earnings) and stock is decremented.
     * Row locking prevents overselling when stock hits 0 concurrently.
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();
        $buyer = $request->user();

        $transaction = DB::transaction(function () use ($data, $buyer) {
            $product = Product::where('id', $data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($product->stock < 1) {
                throw ValidationException::withMessages(['product_id' => 'Stok produk habis.']);
            }

            $product->decrement('stock');

            $seller = $product->shop->user()->lockForUpdate()->first();
            $seller->wallet()->increment('balance', $product->price);

            return Transaction::create([
                'buyer_id'     => $buyer->id,
                'product_id'   => $product->id,
                'amount'       => $product->price,
                'bank_name'    => $data['bank_name'],
                'payment_time' => now(),
                'status'       => 'success',
            ]);
        });

        return response()->json(['transaction' => $transaction], 201);
    }

    public function index(Request $request)
    {
        $transactions = $request->user()
            ->transactions()
            ->with('product:id,title,price,shop_id', 'product.shop:id,name')
            ->latest('created_at')
            ->paginate(15);

        return response()->json($transactions);
    }
}
