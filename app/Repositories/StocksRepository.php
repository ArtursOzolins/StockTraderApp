<?php

namespace App\Repositories;

interface StocksRepository
{
    public function getDataByName(string $companyName);
}
