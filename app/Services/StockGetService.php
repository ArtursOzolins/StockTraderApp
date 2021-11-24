<?php

namespace App\Services;

use App\Models\Stock;
use App\Repositories\StocksRepository;
use Symfony\Component\HttpFoundation\Request;

class StockGetService
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function searchStock(Request $request)
    {
        return $this->stocksRepository->getDataByName($request['company']);
    }

    public function getStockOwnedByUser($user)
    {
        return $user->stock()->get()->all();
    }
}
