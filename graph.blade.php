<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contracts Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var revenueData = google.visualization.arrayToDataTable([
                ['Month', 'Revenue'],
                // Add your revenue data here
            ]);

            var revenueOptions = {
                title: 'Monthly Revenue',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var revenueChart = new google.visualization.LineChart(document.getElementById('revenueChart'));
            revenueChart.draw(revenueData, revenueOptions);

            var departmentData = google.visualization.arrayToDataTable([
                ['Department', 'Number of Contracts'],
                @foreach ($departmentLabels as $index => $departmentLabel)
                    ['{{ $departmentLabel }}', {{ $contractsByDepartment[$index] }}],
                @endforeach

            ]);

            var departmentOptions = {
                title: 'Les pourcentages des contrats par département',
                is3D: true,
            };

            var departmentChart = new google.visualization.PieChart(document.getElementById('departmentPieChart'));
            departmentChart.draw(departmentData, departmentOptions);
        }
    </script>
</head>
<body>
    @if ($droits = Auth::user()->DroitParMenu(Auth::user()->id, 27))
        @extends('layouts.app')

        @section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Statistiques des contrats</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.index') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Statistiques des contrats
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @include('messages.alerts')
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card card-dark">
                            <div class="card-header">
                                <div class="card-title text-center">
                                    Statistiques des contrats - {{ date('d/m/y') }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <a href="{{ route('admin.contrats.index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Retour à la liste
                                </a>
                            </div>
                        </div>

                        <div class="row chart-row">
                            <div class="col-md-4">
                                <div class="chart-container">
                                    <canvas id="revenueChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="chart-container">
                                    <canvas id="countChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                            <div col-md-4 >

                                <div class="col-md-1">
                                    <div class="chart-container">
                                        <div id="departmentPieChart" style="width:397px; height: 200px;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type de Contrat</th>
                                                <th>Frais Total (DH)</th>
                                                <th>Nombre de Contrats</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contractTypes as $typeId => $typeName)
                                            @php
                                            $contractsOfType = $contractsData->where('typecontrat_id', $typeId)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $typeName }}</td>
                                                <td>{{ $contractsOfType ? $contractsOfType->total_amount : 0 }}</td>
                                                <td>{{ $contractsOfType ? $contractsOfType->contract_count : 0 }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- New Table: Contracts by Tiers and Types -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <h3>Nombre de contrats par Tiers et Type de Contrat</h3>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tiers</th>
                                                @foreach ($contractTypes as $typeId => $typeName)
                                                    <th>{{ $typeName }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contractsByTiers as $tiersName => $contractCountsByType)
                                                <tr>
                                                    <td>{{ $tiersName }}</td>
                                                    @foreach ($contractTypes as $typeId => $typeName)
                                                        <td>{{ $contractCountsByType[$typeId] ?? 0 }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End of New Table -->

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <h3>Contrats avec dates de fin dépassées</h3>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>DEBUT</th>
                                                <th>FIN</th>
                                                <th>Tiers</th>
                                                <th>Typecontrat</th>
                                                <th>Departement</th>
                                                <th>Responsable</th>
                                                <th>Montant (DH)</th>
                                                <th>Designation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expiredContracts->where('deleted', 0) as $contrat)
                                                <tr>
                                                    <td>{{ $contrat->id}}</td>
                                                    <td>{{ $contrat->debut}}</td>
                                                    <td class="text-danger">{{ $contrat->fin}}</td>
                                                    <td>{{ $contrat->tiers}}</td>
                                                    <td>{{ $contrat->typecontrat->designation }}</td>
                                                    <td>{{ $contrat->departement->name }}</td>
                                                    <td>{{ $contrat->responsable->name }}</td>
                                                    <td>{{ $contrat->montant }}</td>
                                                    <td>{{ $contrat->designation }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <script>

                            var ctx = document.getElementById('revenueChart').getContext('2d');
                                        var revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Revenu',
                data: {!! json_encode($totalAmounts) !!},
                backgroundColor: [
                    'rgba(31, 58, 147, 1)',
                    'rgba(37, 116, 169, 1)',
                    'rgba(92, 151, 191, 1)',
                    'rgb(200, 247, 197)',
                    'rgb(77, 175, 124)',
                    'rgb(30, 130, 76)'
                ],
                borderColor: [
                    'rgba(31, 58, 147, 1)',
                    'rgba(37, 116, 169, 1)',
                    'rgba(92, 151, 191, 1)',
                    'rgb(200, 247, 197)',
                    'rgb(77, 175, 124)',
                    'rgb(30, 130, 76)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5000000,
                    min: 0,
                    ticks: {
                        stepSize: 500000,
                        callback: function (value, index, values) {
                            return value.toLocaleString('en-US') + ' DH';
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Frais de contrats'
                },
                legend: {
                    display: false,
                }
            }
        }
    });


    var countCtx = document.getElementById('countChart').getContext('2d');
    var countChart = new Chart(countCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nombre de contrats',
                data: {!! json_encode($contractCounts) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1,
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Nombre de contrats par type'
                }
            }
        }
    });
                        </script>
                    </div>



                </div>
            </div>
        </section>
        @endsection
    @endif

</body>
</html>



