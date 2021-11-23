<?php

namespace App\Http\Controllers;

use App\Services\UserFundsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    private $fundService;

    public function __construct(UserFundsService $userFundsService)
    {
        $this->fundService = $userFundsService;
    }

    public function depositFundsView()
    {
        return view('addFundsTab');
    }

    public function depositAmount(Request $request): RedirectResponse
    {
        $this->fundService->addFundsForUser($request['amount']);

        return redirect(route('dashboard'));
    }
}
