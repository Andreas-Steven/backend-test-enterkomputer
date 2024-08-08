<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Promo;
use App\Models\Table;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\TransactionPromo;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $totalPrice = 0;

        // Make Transaction ID
        $transaction->table_id = $request->table_id;
        $transaction->save();

        // Store Order Items
        foreach ($request->items as $item) {
            $transactionItem                    = new TransactionItem();
            $product                            = Product::find($item['product_id']);
            $transactionItem->transaction_id    = $transaction->id;
            $transactionItem->product_id        = $item['product_id'];
            $transactionItem->quantity          = $item['quantity'];
            $transactionItem->price             = ($product->price * $item['quantity']);

            $transactionItem->save();
            $totalPrice += $transactionItem->price;
        }

        // Store Promo Item
        if (!empty($request->promos)) {
            foreach ($request->promos as $promo) {
                $transactionPromo                   = new TransactionPromo();
                $promoItem                          = Promo::find($promo['promo_id']);
                $transactionPromo->transaction_id   = $transaction->id;
                $transactionPromo->promo_id         = $promoItem->id;
                $transactionPromo->quantity         = $promo['quantity'];
                $transactionPromo->price            = ($promoItem->price * $promo['quantity']);
                
                $transactionPromo->save();
                $totalPrice += $transactionPromo->price;
            }
        }

        // Store Total Price
        $transaction->total = $totalPrice;
        $transaction->save();

        // Get Printer Station
        $printerBar = [];
        $printerDapur = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            if ($product->category == "Minuman") {
                $printerBar[] = $product->name . ' ' . $product->variant;
            } else {
                $printerDapur[] = $product->name . ' ' . $product->variant;
            }
        }

        if (!empty($request->promos)) {
            foreach ($request->promos as $promo) {
                $promo = Promo::find($promo['promo_id']);

                $printerBar[]   = substr($promo->name, strpos($promo->name, "+") + 2);
                $printerDapur[] = substr($promo->name, 0, strpos($promo->name, "+") - 1); 
            }
        }

        // Give Response
        return response()->json([
            'message'           => 'Order created successfully',
            'transaction_id'    => $transaction->id,
            'table_id'          => $transaction->table_id,
            'printers'          => [
                'Printer Dapur' => $printerDapur,
                'Printer Bar'   => $printerBar,
                'Printer Kasir' => $totalPrice,
            ],
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['table', 'transactionItem.product', 'transactionPromo.promo'])->findOrFail($id);

        // Response Format
        $response = [
            'transaction_id' => $transaction->id,
            'table_name' => $transaction->table->name,
            'total_price' => $transaction->total,
            'items' => $transaction->transactionItem->map(function($transactionItem) {
                return [
                    'product_id'    => $transactionItem->product_id,
                    'product_name'  => $transactionItem->product->name,
                    'quantity'      => $transactionItem->quantity,
                    'price'         => $transactionItem->price
                ];
            }),
            'promos' => $transaction->transactionPromo->map(function($transactionPromo) {
                return [
                    'promo_id'      => $transactionPromo->promo_id,
                    'promo_name'    => $transactionPromo->promo->name,
                    'quantity'      => $transactionPromo->quantity,
                    'price'         => $transactionPromo->price
                ];
            })
        ];

        return response()->json($response);
    }
}
