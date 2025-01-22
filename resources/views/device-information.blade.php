<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Device Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Latest Device Info -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Latest Device Information</h3>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $deviceInfo->ip ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">MAC Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $deviceInfo->mac ?? 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <br>

            <!-- Current Environment -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Current Environment</h3>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Temperature</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $latestTemperature->temperature ?? 'N/A' }} &#8451;</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Humidity</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $latestTemperature->humidity ?? 'N/A' }} %</dd>
                    </div>
                </div>
            </div>
            
            <br>

            <!-- Connection Status -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">ESP32 Connection Status</h3>
                <div class="mt-4">
                    @if ($connectionStatus)
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Connected
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Disconnected
                        </span>
                    @endif
                </div>
            </div>

            <br>

            <!-- Graph for Internal Temperature -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Temperature and Humidity Trends</h3>
                <div class="mt-4">
                    <canvas id="temperatureGraph"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('temperatureGraph').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($temperatureData->pluck('timestamp')->toArray()) !!},
                    datasets: [
                        {
                            label: 'Temperature (°C)',
                            data: {!! json_encode($temperatureData->pluck('temperature')->toArray()) !!},
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Humidity (%)',
                            data: {!! json_encode($temperatureData->pluck('humidity')->toArray()) !!},
                            borderColor: 'rgba(255, 99, 132, 1)',
                            fill: false,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Timestamp'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
