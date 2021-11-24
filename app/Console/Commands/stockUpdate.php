<?php

namespace App\Console\Commands;

use App\Repositories\FinnhubStocksRepository;
use App\Repositories\StocksRepository;
use App\Services\StockGetService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class stockUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        parent::__construct();

        $this->stocksRepository = $stocksRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $records = DB::table('stocks')->get();


        foreach ($records as $record)
        {
            $newest_price = $this->stocksRepository->getDataByName(str_replace(' Inc','',$record->name))['currentPrice'];

            DB::table('stocks')
                ->where('id', $record->id)
                ->update(['newest_price' => $newest_price]);
        }
    }
}
