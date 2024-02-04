
@extends('layouts.app')

@if ($droits=Auth::user()->DroitParMenu(Auth::user()->id,27))
@endif

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mise à jour Contrat</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active">
                      Mise à jour Contrat
                    </li>
                </ol>
            </div>

        </div>

    </div>

</div>

<!-- Main content -->

<section class="content">
        <div class="col-md-12">

@include('messages.alerts')
<form action="{{ route('admin.contrats.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

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
                                <input type="hidden" value="{{ $contrats->id }} " name="id">

                                       <div class="row">

                                          <div class="col-md-6">
                                             <div class="form-group">
                                                 <label for="">Debut</label>
                                                 <input type="date" name="debut" value="{{ date('Y-m-d', strtotime($contrats->debut)) }}" class="form-control">
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
                                                 <input type="date" name="fin" value="{{ date('Y-m-d', strtotime($contrats->fin)) }}" class="form-control">
                                                 @error('fin')
                                                     <div class="text-danger">
                                                         {{ $message }}
                                                     </div>
                                                 @enderror
                                        </div>
                                </div>

                                    </div>
                                </div>

                                   <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label  for="">Responsable</label>
                                                 <select id="options" name="user_id"  class="form-control txt">
                                                    <option value="{{ $contrats->user_id }}">{{ $contrats->responsable->name  }} </option>
                                                    @foreach ( $responsable as $responsable )
                                                                <option value="{{ $responsable->id }}">{{ $responsable->name }}</option>
                                                    @endforeach
                                                </select>

                                                 @error('responsable_id ')
                                                     <div class="text-danger">
                                                         {{ $message }}
                                                     </div>
                                                 @enderror
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                 <label for="">Montant</label>
                                                 <input type="text" name="montant" value="{{ $contrats->montant }}" class="form-control">
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
                                                  <label for="">TypeContrats</label>
                                                  <select id="options" name="typecontrat_id" class="form-control txt">
                                                    <option value="{{ $contrats->typecontrat_id }}">{{ $contrats->typecontrat->designation  }} </option>
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
                        <option value="{{ $contrats->departement_id }}">{{ $contrats->departement->name  }} </option>
                        @foreach ( $departement as $department )
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                                                  @error('departement_id')
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
                                                   <input type="text" name="tiers" value="{{$contrats->tiers }}" class="form-control">
                                                   @error('tiers')
                                                       <div class="text-danger">
                                                           {{ $message }}
                                                       </div>
                                                   @enderror
                                               </div>
                                            </div>
                                               <div class="col-md-6">
                                                   <label for="">Designation</label>
                                                   <input type="text" name="designation" value="{{ $contrats->designation }}" class="form-control">
                                                   @error('designation')
                                                       <div class="text-danger">
                                                           {{ $message }}
                                                       </div>
                                                   @enderror
                                               </div>

                                            </div>
                                            {{-- <div class="col-md-6">
                                                <label for="">Uploader un Fichier</label>
                                                <input type="file" name="pdf_url" value="{{ $contrats->pdf_url }}" class="form-control-file">
                                                @error('pdf_url')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Le fichier existe:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="{{ $contrats->pdf_url }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Choose a new PDF file -->
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Veuillez modifier le fichier :</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control-file" name="pdf_url">
                                                </div>
                                            </div>

                                        </fieldset>

                                        <div class="col-md-12 text-center">
                                            <a href="{{ route('admin.contrats.details', ['id' => $contrats->id]) }}"       class="btn btn-flat bg-info"  style="width: 40%; font-size: 1.3rem; border-radius: 10px;">
                                                <i class="fas fa-file"></i> Voir les détails du contrat
                                            </a>
                                        </div>

                                     </div>

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
                             @if ($droits->Imprimer)
                             <button type="button" class="btn btn-flat bg-info" style="width: 40%; font-size: 1.3rem" onclick="downloadDataAsPDF()">
                                <i class="fas fa-download"></i> Télécharger
                              </button>

                             @endif

                            </div>
                       </div>

               </div>


     </div>

  </section>

@endsection

@section('extra-js')
<script>
    function downloadDataAsPDF() {
        // Replace the URL with the correct route that points to the downloadPDF method
        const url = "{{ route('admin.contrats.download-pdf', ['id' => $contrats->id]) }}";

        // Open the URL in a new tab to trigger the download
        window.open(url, '_blank');
    }
</script>

@endsection
