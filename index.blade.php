
@extends('layouts.app')
@if ($droits=Auth::user()->DroitParMenu(Auth::user()->id,27))
@endif
@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Liste des Contrats</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active">
                       Liste des Cpntrats
                    </li>
                </ol>
            </div>
            <div class="row mt-2">
                <div class="col-md-12 text-right">
                    <a href="{{ route('admin.contrats.graph') }}" class="btn btn-round btn-info">
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Aller aux statistiques graphiques
                    </a>
                </div>
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
                                Liste des contrats
                            </div>

                        </div>
                        <div class="card-body">
                        <div class="row mt-2 mr-2 mb-2">
                            @if ($droits->Ajouter)
                                <div class="col-md-12  text-right">
                                        <a
                                                href="{{ route('admin.contrats.create') }}"
                                                class="btn btn-round btn-success"
                                                ><i class="fas fa-plus" aria-hidden="true"> </i> Nouveau contrat</a>
                                </div>
                            @endif


                        </div>
                         <hr/>
                            @if ($data->count())
                            <table class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed" id="dataTable" style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>DEBUT</th>
                                        <th>FIN</th>
                                        <th>Tiers</th>
                                        <th>Typecontrat</th>
                                        <th>Departement</th>
                                        <th>Responsable</th>
                                        <th>Montant(DH)</th>
                                        <th>Designation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $contrat)
                                    @php
                                $today = now();
                                $endDate = \Carbon\Carbon::parse($contrat->fin);
                                $isExpired = $today->gt($endDate);
                                @endphp
                                    <tr @if($isExpired) class="table-danger" @endif>
                                        <td>{{ $contrat->id}}</td>
                                        <td>{{ $contrat->debut}}</td>
                                        <td>{{ $contrat->fin}}</td>
                                        <td>{{ $contrat->tiers}}</td>
                                        <td>{{ $contrat->typecontrat->designation }}</td>
                                        <td>{{ $contrat->departement->name }}</td>
                                        <td> {{ $contrat->responsable->name }}</td>
                                        <td>{{ $contrat->montant }}</td>
                                        <td>{{ $contrat->designation }}</td>
                                        <td>
                                            @if ($droits->Modifier)
                                                <a class="btn  btn-primary btn-xs  tooltipx" tip="Détails"  href="{{ route('admin.contrats.edit', $contrat->id) }}"><i class="fas fa-th-list" aria-hidden="true"></i></a>
                                            @endif

                                            @if($droits->Supprimer)

                                            <a class="btn btn-danger btn-xs tooltipx" tip="Supprimer" href="#" onclick="confirmDeletion('{{ route('admin.contrats.destroycontrat', $contrat->id) }}')">
                                                <i class="fas fa-remove" aria-hidden="true"></i>
                                            </a>
                                            @endif

                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>Aucun enregistrement disponible</h4>
                            </div>
                            @endif

                        </div>
                    </div>
                    <!-- general form elements -->

                </div>
            </div>
        </div>

    </section>

@endsection
@section('extra-js')

@parent
    <script>

    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
            language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
              }
        });
    });
</script>

<script>
    function confirmDeletion(deleteUrl) {
        if (confirm('Voulez-vous vraiment supprimer ce contrat ?')) {
            // If the user confirms, redirect to the delete URL
            window.location.href = deleteUrl;
        } else {
            // If the user cancels, do nothing
        }
    }
    </script>
@endsection





