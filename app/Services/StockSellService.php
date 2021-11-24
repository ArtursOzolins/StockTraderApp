<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

class StockSellService
{
    public function sellStock(Request $request)
    {
        $stock = auth()->user()->stock()->get()->find($request->get('id'));

        if($request->get('amount') == $stock->getAmount())
        {
            $stock->delete();
            auth()->user()->addFunds($request->get('amount')*$request->get('price'));
            auth()->user()->save();
        } else {
            $stock->setAmount($stock->getAmount()-$request->get('amount'));
            $stock->save();
            auth()->user()->addFunds($request->get('amount')*$request->get('price'));
            auth()->user()->save();
        }
    }
}
