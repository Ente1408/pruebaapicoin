<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CoinMarketCapService
{
    protected string $baseUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency";

    /**
     * Obtener cotizaciones de criptomonedas
     *
     * @param string $symbols Ejemplo: "BTC,ETH,SOL"
     * @return array|null
     */
    public function getQuotes(string $symbols = "BTC,ETH"): ?array
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key'),
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/quotes/latest", [
            'symbol' => $symbols,
            'convert' => 'USD',
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    /**
     * Listado de criptomonedas (para seleccionar)
     */
    public function getListings(): ?array
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key'),
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/listings/latest", [
            'limit' => 10,
            'convert' => 'USD',
        ]);

        return $response->successful() ? $response->json() : null;
    }
}
