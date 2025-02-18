@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Paiement</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">
                    <a href="{{ route('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Client
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">
                    <input type="hidden" id="client_id" value="{{$client->id}}">
                    <a href="{{ route('clients.view', $client->id) }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Commande
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Report RDV</li>
            </ul>
        </div>
        <div class="row gy-4">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                    <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                        <div class="row">
                            <div class="col-sm-6 mb-10">
                                <h6 class="text-lg mb-0">{{ $client->nom_complet.'  '. $client->matricule}} </h6>
                                <input type="hidden" id="client_id" value="{{$client->id}}">
                                <input type="hidden" id="commande_id" value="{{$commande->id}}">
                            </div>
                            <div class="col-sm-6 mb-10">
                                <h6 class="text-lg mb-0">{{ $commande->numero_commande.' date du RDV: '.date("d/m/Y", strtotime($commande->date_rdv))}} </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table bordered-table mb-0 display responsive nowrap" id="commandeReportRDVTable" data-page-length='10' width="100%">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </th>
                                <th scope="col">Date de Report RDV</th>
                                <th scope="col">Motif</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($reports) && count($reports) > 0 )
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input" id="report-input-check" value="{{ $report->id }}" type="checkbox">
                                            </div>
                                        </td>
                                        <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{date("d/m/Y", strtotime($report->date_rdv))}}</h6></td>
                                        <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $report->motif}}</h6></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Modal add report RDV--}}
    <div class="modal fade" id="addReportRDVModal" tabindex="-1" aria-labelledby="addReportRDVModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addCommandeModalLabel">Ajouter un report du RDV</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.commande.report.store') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de Report RDV<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" id="date_report" type="text" name="date_report"  @error('date_report') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_report')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Motif <span class="text-danger-600">*</span></label>
                                <textarea class="form-control radius-8" rows="4"  name="report_motif" @error('report_motif') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror></textarea>
                                <input type="hidden" name="commande_id_report" id="commande_id_report" value="{{$commande->id}}">
                                @error('report_motif')
                                <span class="text-danger-main fw-semibold">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <div class="row">
                                <div class="col-sm-6 mb-10">
                                    <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        Enregistrer
                                    </button>
                                </div>
                                <div class="col-sm-6 mb-10">
                                    <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

{{--    Update report RDV modal--}}
        <div class="modal fade" id="updateReportRDVModal" tabindex="-1" aria-labelledby="updateReportRDVModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
                <div class="modal-content radius-16 bg-base">
                    <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                        <h1 class="modal-title fs-5" id="addCommandeModalLabel">Modifier un report du RDV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-24">
                        <form action="{{ route('client.commande.report.update') }}" method="POST">
                            @csrf()
                            <div class="row">
                                <div class="col-12 mb-20">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de Report RDV<span class="text-danger-600">*</span></label>
                                    <div class=" position-relative">
                                        <input class="form-control radius-8 bg-base" id="date_report_up" type="text" name="date_report_up" value="" @error('date_report_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                        <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                        @error('date_report_up')
                                        <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">Motif <span class="text-danger-600">*</span></label>
                                    <textarea class="form-control radius-8" rows="4" id="report_motif_up"  name="report_motif_up" @error('report_motif_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value=""></textarea>
                                    <input type="hidden" name="commande_id_report_up" id="commande_id_report_up" value="">
                                    @error('report_motif_up')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <div class="row">
                                    <div class="col-sm-6 mb-10">
                                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Enregistrer
                                        </button>
                                    </div>
                                    <div class="col-sm-6 mb-10">
                                        <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('scripts')
    <script  src="{{ asset('assets/js/gfi/clients/report/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/clients/report/datatable.js') }}"></script>
@endsection
