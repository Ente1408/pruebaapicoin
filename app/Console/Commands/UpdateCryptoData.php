<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CoinMarketCapService;
use App\Models\Crypto;

class UpdateCryptoData extends Command {
    protected $signature = 'crypto:update';
    protected $description = 'Actualizar precios de criptomonedas';

    public function handle(CoinMarketCapService $cmc) {
        $data = $cmc->getQuotes("BTC,ETH,BNB,SOL");
        foreach ($data['data'] as $symbol => $info) {
            Crypto::updateOrCreate(
                ['symbol' => $symbol],
                [
                    'name' => $info['name'],
                    'price' => $info['quote']['USD']['price'],
                    'percent_change_24h' => $info['quote']['USD']['percent_change_24h'],
                    'volume_24h' => $info['quote']['USD']['volume_24h'],
                ]
            );
        }
        $this->info("Datos de criptomonedas actualizados");
    }
}
