<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CoinMarketCapService;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CoinMarketCapService $cmc)
    {
        $data = $cmc->getQuotes("BTC,ETH,BNB");

        return view('dashboard', [
            'cryptos' => $data['data'] ?? [],
        ]);
    }

}
