<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'symbol',
        'name',
        'purchased_for',
        'newest_price',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getID()
    {
        return $this->id;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPurchasedFor()
    {
        return $this->purchased_for;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getNewestValue()
    {
        return $this->newest_price;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}
