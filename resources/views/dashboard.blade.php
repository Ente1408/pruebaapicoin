<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crypto Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Monedas en Tiempo Real</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($cryptos as $coin)
                        <div class="p-4 bg-gray-50 border rounded shadow">
                            <h2 class="font-semibold">{{ $coin['name'] }} ({{ $coin['symbol'] }})</h2>
                            <p>💲 {{ number_format($coin['quote']['USD']['price'], 2) }}</p>
                            <p class="{{ $coin['quote']['USD']['percent_change_24h'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($coin['quote']['USD']['percent_change_24h'], 2) }} %
                            </p>
                            <p>📊 Volumen: {{ number_format($coin['quote']['USD']['volume_24h'], 2) }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Gráfico dinámico --}}
                <div class="mt-8">
                    <canvas id="cryptoChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const cryptos = @json($cryptos);

        const labels = Object.values(cryptos).map(c => c.symbol);
        const prices = Object.values(cryptos).map(c => c.quote.USD.price);

        const ctx = document.getElementById('cryptoChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Precio en USD',
                    data: prices,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false,
                }]
            }
        });
    </script>
</x-app-layout>
