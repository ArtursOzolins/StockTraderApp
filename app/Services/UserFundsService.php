<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserFundsService
{
    public function getFundsOfUser(): int
    {
        return Auth::user()->getFunds();
    }

    public function addFundsForUser($amount): void
    {
        Auth::user()->addFunds($amount);
        Auth::user()->save();
    }

    public function decreaseFundsForUser($amount): void
    {
        Auth::user()->decreaseFunds($amount);
        Auth::user()->save();
    }
}
