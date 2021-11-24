<?php

namespace App\Services;

use App\Models\Stock;
use Symfony\Component\HttpFoundation\Request;

class StockPurchaseService
{
    public function purchaseStock(Request $request)
    {
        $existingStock = auth()->user()->stock()->get()->first(
            function ($stock) use ($request) {
                return $stock->symbol == $request['symbol'];
            });

        if ($existingStock == null)
        {
            $stock = new Stock([
                'symbol' => $request['symbol'],
                'name' => $request['name'],
                'purchased_for' => $request['currentPrice'],
                'newest_price' => $request['currentPrice'],
                'amount' => $request['amount']
            ]);
            $stock->user()->associate(auth()->user());
            $stock->save();
        } else {
            $existingStock->setAmount((int)$existingStock->getAmount() + (int)$request['amount']);
            $existingStock->save();
        }

        $user = auth()->user();
        $user->decreaseFunds($request['currentPrice']*$request['amount']);
        $user->save();
    }
}
