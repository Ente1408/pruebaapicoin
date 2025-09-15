<x-app-layout>
    <x-slot name="header">
        @routes
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crypto Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Monedas en Tiempo Real</h1>

                <div id="crypto-cards" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
        let chart;

        // Inicializar gráfico
        function initChart(data) {
            const labels = data.map(c => c.symbol);
            const prices = data.map(c => c.quote.USD.price);
            console.log(labels, prices);
            console.log(data);
            const ctx = document.getElementById('cryptoChart');
            chart = new Chart(ctx, {
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
        }

        // Actualizar gráfico con nuevos datos
        function updateChart(data) {
            chart.data.labels = data.map(c => c.symbol);
            chart.data.datasets[0].data = data.map(c => c.quote.USD.price);
            console.log(data);
            chart.update();
        }

        // Actualizar tarjetas
        function updateCards(data) {
            let container = document.getElementById('crypto-cards');
            container.innerHTML = '';

            data.forEach(coin => {
                  const price = coin.quote?.USD?.price ?? 0;
                    const percent = coin.quote?.USD?.percent_change_24h ?? 0;
                    const volume = coin.quote?.USD?.volume_24h ?? 0;

                    container.innerHTML += `
                        <div class="p-4 bg-gray-50 border rounded shadow">
                            <h2 class="font-semibold">${coin.name} (${coin.symbol})</h2>
                            <p>💲 ${price.toFixed(2)}</p>
                            <p class="${percent > 0 ? 'text-green-600' : 'text-red-600'}">
                                ${percent.toFixed(2)} %
                            </p>
                            <p>📊 Volumen: ${volume.toFixed(2)}</p>
                        </div>
                    `;
            });
        }

        // Cargar datos desde la API
        async function loadData() {
            const res = await fetch(route('cryptos.data'));
            const json = await res.json();

            
            const data = Object.values(json.data); 

            if (!chart) {
                initChart(data);
            } else {
                updateChart(data);
            }
            updateCards(data);
        }

        // Primera carga
        loadData();

        // Refrescar cada 30 segundos
        setInterval(loadData, 30000);
    </script>
</x-app-layout>
