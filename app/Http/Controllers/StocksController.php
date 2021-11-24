<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Repositories\StocksRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;
    private ?array $company=null;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;

    }

    public function searchView(Request $request)
    {
        if ($request['company'] != null) {
            $this->company = $this->stocksRepository->getDataByName($request['company']);
        }

        return view('searchTab', ['company' => $this->company]);
    }

    public function purchase(Request $request): RedirectResponse
    {
        $stock = new Stock([
            'symbol' => $request['symbol'],
            'name' => $request['name'],
            'purchased_for' => $request['currentPrice'],
            'amount' => $request['amount']
        ]);
        $stock->user()->associate(auth()->user());
        $stock->save();

        $user = auth()->user();
        $user->decreaseFunds($request['currentPrice']*$request['amount']);
        $user->save();

        return redirect(route('stocks.owned'));
    }

    public function ownedView()
    {
        $userStock = auth()->user()->stock()->get()->all();

        return view('ownedStocksTab', ['stock' => $userStock]);
    }

    public function sell(Request $request): RedirectResponse
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


        return redirect(route('stocks.owned'));
    }
}
