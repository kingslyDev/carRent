@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Vehicle Usage Report by Day</h1>
        <canvas id="vehicleUsageChart"></canvas>
    </div>
@endsection
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('vehicleUsageChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [
                        @foreach($chartsData as $vehicleName => $data)
                        {
                            label: '{{ $vehicleName }}',
                            data: [{{ $data['January'] }}, {{ $data['February'] }}, {{ $data['March'] }},{{ $data['April'] }}, {{ $data['May'] }},{{ $data['June'] }},{{ $data['July'] }},{{ $data['August'] }},{{ $data['September'] }},{{ $data['October'] }},{{ $data['November'] }},{{ $data['December'] }}],
                            backgroundColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                            borderColor: 'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 1)',
                            borderWidth: 1
                        },
                        @endforeach
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50,
                            ticks: {
                                stepSize: 5
                            }
                            
                        }
                    }
                }
            });
        });
    </script>