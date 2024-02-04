
@extends('layouts.app')
@if ($droits=Auth::user()->DroitParMenu(Auth::user()->id,27))
@endif
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ajouter un contrat</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active">
                      Ajouter un contrat
                    </li>
                </ol>
            </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
        <div class="col-md-12">

@include('messages.alerts')
<form action="{{ route('admin.contrats.store') }}" enctype="multipart/form-data"  method="POST">
                        @csrf
                        @method('POST')
           <div class="card-body">

             <div class="card card-dark card-tabs">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-1" data-toggle="pill" href="#identification" role="tab" aria-controls="custom-tabs-one-1" aria-selected="true">Identification</a>
                      </li>

                    </ul>
                  </div>

                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                       <div class="tab-pane fade active show" id="identification" role="tabpanel" aria-labelledby="custom-tabs-one-1">

                              <fieldset>
                                <div class="row">

                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Debut</label>
                                            <input type="date" name="debut" value="{{ old('debut') }}" class="form-control txt">
                                            @error('debut')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="">Fin</label>
                                             <input type="date" name="fin" value="{{ old('fin') }}" class="form-control txt">
                                             @error('fin')
                                                 <div class="text-danger">
                                                     {{ $message }}
                                                 </div>
                                             @enderror
                                         </div>
                                      </div>

                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="">TypeContrats</label>

                                             <select id="options" name="typecontrat_id" class="form-control txt">
                                                @foreach ( $typecontrats as $typecontrat )
                                                <option value="{{ $typecontrat->id }}">{{ $typecontrat->designation }}</option>
                                                @endforeach
                                            </select>

                                             @error('typecontrat_id')
                                                 <div class="text-danger">
                                                     {{ $message }}
                                                 </div>
                                             @enderror
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="">Departement</label>
                                             <select id="options" name="departement_id" class="form-control txt">
                                                @foreach ( $departement as $department )
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>

                                             @error('department_id')
                                                 <div class="text-danger">
                                                     {{ $message }}
                                                 </div>
                                             @enderror
                                         </div>
                                      </div>

                                 </div>


                                 <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                            <label   for="">Responsable</label>
                                            <select id="options" name="user_id"  class="form-control txt">
                                                @foreach ( $responsable as $responsable )
                                                    <option value="{{ $responsable->id }}">{{ $responsable->name }}</option>
                                                @endforeach
                                            </select>


                                            @error('responsable_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="">Montant(DH)</label>
                                            <input type="text" name="montant" value="{{ old('montant') }}" class="form-control txt">
                                            @error('montant')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                     </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="">Tiers</label>
                                           <input type="text" name="tiers" value="{{ old('tiers') }}" class="form-control txt">
                                           @error('tiers')
                                               <div class="text-danger">
                                                   {{ $message }}
                                               </div>
                                           @enderror
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="">Designation</label>
                                           <input type="text" name="designation" value="{{ old('designation') }}" class="form-control txt" >
                                           @error('designation')
                                               <div class="text-danger">
                                                   {{ $message }}
                                               </div>
                                           @enderror
                                       </div>
                                    </div>
                                    </div>


                            </fieldset>
                       </div>


                     </div>
                   </div>
            </div>

                       <div class="card-footer text-center">
                        <div class="row">

                              <div class="col-md-12">
                             @if ($droits->Modifier)
                                     <button type="submit" class="btn btn-flat bg-dark" style="width: 40%; font-size:1.3rem"><i class="fas fa-save"></i> Enregistrer</button>
                              @endif

                             </div>
                        </div>

                </div>
</div>


                </form>
                   @include('includes.admin.models')
                </div>


 </section>

@endsection






