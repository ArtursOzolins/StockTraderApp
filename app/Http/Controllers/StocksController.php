<?php

namespace App\Http\Controllers;

use App\Repositories\StocksRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        

        return redirect(route('dashboard'));
    }
}
