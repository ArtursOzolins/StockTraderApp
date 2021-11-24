<?php

namespace App\Services;

class StockSellService
{
    public function sellStock(int $id, int $amount, float $price)
    {
        $stock = auth()->user()->stock()->get()->find($id);

        if($amount == $stock->getAmount())
        {
            $stock->delete();
            auth()->user()->addFunds($amount * $price);
            auth()->user()->save();
        } else {
            $stock->setAmount((float)$stock->getAmount() - $amount);
            $stock->save();
            auth()->user()->addFunds($amount * $price);
            auth()->user()->save();
        }
    }
}
