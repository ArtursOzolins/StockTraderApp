<?php

namespace App\Services;

use App\Models\Stock;
use Symfony\Component\HttpFoundation\Request;

class StockPurchaseService
{
    public function purchaseStock(string $symbol, string $name, string $currentPrice, string $amount)
    {
        $existingStock = auth()->user()->stock()->get()->first(
            function ($stock) use ($symbol) {
                return $stock->symbol == $symbol;
            });

        if ($existingStock == null)
        {
            $stock = new Stock([
                'symbol' => $symbol,
                'name' => $name,
                'purchased_for' => $currentPrice,
                'newest_price' => $currentPrice,
                'amount' => $amount
            ]);
            $stock->user()->associate(auth()->user());
            $stock->save();
        } else {
            $existingStock->setAmount((int)$existingStock->getAmount() + (int)$amount);
            $existingStock->save();
        }

        $user = auth()->user();
        $user->decreaseFunds($currentPrice * $amount);
        $user->save();
    }
}
