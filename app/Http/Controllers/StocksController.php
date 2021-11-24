<?php

namespace App\Http\Controllers;

use App\Repositories\StocksRepository;
use App\Services\StockGetService;
use App\Services\StockPurchaseService;
use App\Services\StockSellService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;
    private ?array $company=null;

    private $stockGetService;
    private $stockPurchaseService;
    private $stockSellService;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;

        $this->stockGetService = new StockGetService($this->stocksRepository);
        $this->stockPurchaseService = new StockPurchaseService();
        $this->stockSellService = new StockSellService();
    }

    public function searchView(Request $request)
    {
        if ($request['company'] != null) {
            $this->company = $this->stockGetService->searchStock($request);
        }

        return view('searchTab', ['company' => $this->company]);
    }

    public function purchase(Request $request): RedirectResponse
    {
        $this->stockPurchaseService->purchaseStock($request);

        return redirect(route('stocks.owned'));
    }

    public function ownedView()
    {
        $userStock = $this->stockGetService->getStockOwnedByUser(auth()->user());

        return view('ownedStocksTab', ['stock' => $userStock]);
    }

    public function sell(Request $request): RedirectResponse
    {
        $this->stockSellService->sellStock($request);

        return redirect(route('stocks.owned'));
    }
}
