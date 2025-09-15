<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CoinMarketCapService;

class CryptoController extends Controller
{
    public function index(CoinMarketCapService $cmc)
    {
        $data = $cmc->getQuotes("BTC,ETH,BNB");

        return response()->json($data);
    }
}
