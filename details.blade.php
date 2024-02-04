
@if ($droits=Auth::user()->DroitParMenu(Auth::user()->id,27))
@endif
@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Les détaills  des contrats</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active">
                       Les détails des contrats
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
                           Les détails des contrats
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-lg">
                            <div class="card-header bg-info text-white">
                                <div class="header-content">
                                    <h3 class="mb-0">Contrat de {{ $contrat->typecontrat->designation }}</h3>

                                    <p>Date: {{ date('Y-m-d') }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Contract details -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Date de début:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->debut }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Date de fin:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->fin }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Tiers:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->tiers }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Montant(DH):</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->montant }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Département:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->departement->name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Responsable:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->responsable->name }}
                                    </div>
                                </div>
                                 <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>le fichier de contat:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->pdf_url }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Designation:</strong>
                                    </div>
                                    <div class="col-md-8">
                                        {{ $contrat->designation }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.contrats.index') }}" class="btn btn-secondary">Retour à la liste</a>
                                </div>


                    </div>
                </div>
            </div>
               </div>
            </div>
        </div>
            </section>

    @endsection











