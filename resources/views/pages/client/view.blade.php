@extends('layouts.app')

@section('heads')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Client</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route ('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Clients
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Détails</li>
        </ul>
    </div>
    <div class="row gy-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <div class="d-flex flex-wrap align-items-center justify-content-start gap-2">
                        <h6 class="text-lg mb-0">{{ $client->nom_complet.'  '. $client->matricule}} </h6>
                        <input type="hidden" id="client_id" value="{{$client->id}}">
                        @if(isset($mesure) && count($mesure) > 0 )
                            <input type="hidden" id="mesure_id" value="{{$mesure[0]->id}}">
                            @else
                            <input type="hidden" id="mesure_id" value="0">
                        @endif
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                        <a href="{{ route('clients.statistique',$client->id) }}" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="pepicons-pencil:paper-plane" class="text-xl"></iconify-icon>
                            Statistiques
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="solar:download-linear" class="text-xl"></iconify-icon>
                            Recommandation
                        </a>
                    </div>
                </div>
                <div class="card-body p-24 pt-10">
                    <ul class="nav bordered-tab border border-top-0 border-start-0 border-end-0 d-inline-flex nav-pills mb-16" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10 active" id="commande-tab" data-bs-toggle="pill" data-bs-target="#commande" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Commande</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10" id="mesure-tab" data-bs-toggle="pill" data-bs-target="#mesure" type="button" role="tab" aria-controls="pills-details" aria-selected="false">Mesure</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10" id="tissu-tab" data-bs-toggle="pill" data-bs-target="#tissu" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Tissu</button>
                        </li>
{{--                        <li class="nav-item" role="presentation">--}}
{{--                            <button class="nav-link px-16 py-10" id="report-tab" data-bs-toggle="pill" data-bs-target="report" type="button" role="tab" aria-controls="report" aria-selected="false">RDV</button>--}}
{{--                        </li>--}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10" id="remarques-tab" data-bs-toggle="pill" data-bs-target="#remarques" type="button" role="tab" aria-controls="pills-settings" aria-selected="false">Remarques</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="commande" role="tabpanel" aria-labelledby="commande-tab" tabindex="0">
                            <table class="table bordered-table mb-0 display responsive nowrap" id="clientCommandeTable" data-page-length='10' width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </th>
                                    <th scope="col">Date de création</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Numéro de commande</th>
                                    <th scope="col">Date de RDV</th>
                                    <th scope="col">Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($commandes) && count($commandes) > 0 )
                                    @foreach ($commandes as $commande)
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" id="client-commande-input-check" value="{{ $commande->id }}" type="checkbox">
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ date("d/m/Y", strtotime($commande->created_at)) }}</h6>
                                            </td>
                                            <td>{{ $commande->total }}</td>
                                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $commande->numero_commande }}</h6></td>
                                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1"> {{date('d/m/Y', strtotime($commande->date_rdv))}}</h6></td>
                                            <td>
                                                @if($commande->statut == env('STATUS_SUCCESS'))
                                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Terminé</span>
                                                @elseif($commande->statut == env('STATUS_FAILED'))
                                                    <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">En cours</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="mesure" role="tabpanel" aria-labelledby="mesure-tab" tabindex="0">
                            <table class="table bordered-table mb-0 display responsive nowrap" id="clientMesureTable" data-page-length='10' width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Epaule</th>
                                    <th scope="col">Poitrine</th>
                                    <th scope="col">Bas</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($mesure) && count($mesure) > 0 )
                                        @foreach ($mesure as $mesure)
                                            <tr>
                                                <td>{{date('d/m/Y', strtotime($mesure->updated_at))}}</td>
                                                <td>{{$mesure->sexe}}</td>
                                                <td>{{$mesure->epaule}}</td>
                                                <td>{{$mesure->poitrine}}</td>
                                                <td>{{$mesure->bas}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tissu" role="tabpanel" aria-labelledby="tissu-tab" tabindex="0">
                            <table class="table bordered-table mb-0 display responsive nowrap" id="clientTissuTable" data-page-length='10' width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( count($tissus) > 0 )
                                    @foreach ($tissus as $tissu)
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" id="client-tissu-input-check" value="{{ $tissu->id }}" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{date('d/m/Y', strtotime($tissu->updated_at))}}</td>
                                            <td>{{$tissu->nom}}</td>
                                            <td>{{$tissu->description}}</td>
                                            <td>
                                                @if($tissu->statut == env('STATUS_SUCCESS'))
                                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Actif</span>
                                                @elseif($tissu->statut == env('STATUS_FAILED'))
                                                    <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Inactif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="remarques" role="tabpanel" aria-labelledby="remarques-tab" tabindex="0">
                            <table class="table bordered-table mb-0 display responsive nowrap" id="clientRemarquesTable" data-page-length='10' width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </th>
                                    <th scope="col">Commande</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( count($remarques) > 0 )
                                    @foreach ($remarques as $remarque)
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" id="client-remarques-input-check" value="{{ $remarque->id }}" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{$remarque->commande->numero_commande}}</td>
                                            <td>{{$remarque->commentaire}}</td>
                                            <td>{{date('d/m/Y', strtotime($remarque->updated_at))}}</td>
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
    </div>

    {{--Modal add commande--}}
    <div class="modal fade" id="addCommandeModal" tabindex="-1" aria-labelledby="addCommandeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addCommandeModalLabel">Ajouter une commande</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.commande.store') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de création<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" id="date_created" type="text" name="date_created" placeholder="{{ date('d/m/Y') }}" @error('date_created') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_created')
                                        <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de RDV <span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" id="date_rdv" type="text" name="date_rdv" placeholder="{{ date('d/m/Y') }}" @error('date_rdv') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_rdv')
                                        <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro de commande <span class="text-danger-600">*</span></label>
                                <input type="text" class="form-control radius-8" readonly value="{{ $numeroCommande }}" id="numero_commande" name="numero_commande">
                                <input type="hidden" name="client_id_cmd" id="client_id_cmd" value="{{$client->id}}">
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

    {{--Modal update commande--}}
    <div class="modal fade" id="updateCommandeModal" tabindex="-1" aria-labelledby="updateCommandeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addCommandeModalLabel">Modifier une commande</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.commande.update') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de création<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" type="text"  id="date_created_up" name="date_created_up" value="" @error('date_created') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_created')
                                    <span class="text-danger-main fw-semibold">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro de commande <span class="text-danger-600">*</span></label>
                                <input type="text" id="numero_commande_up" class="form-control radius-8" readonly value="">
                                <input type="hidden" id="commande_id_up" name="commande_id" value="">
                                <input type="hidden" name="client_id_cmd" value="{{$client->id}}">
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Statut de la commande <span class="text-danger-600">*</span></label>
                                <select class="form-control radius-8" id="statut_up" name="statut" required>

                                </select>
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

{{--    Modal add Remarque--}}
    <div class="modal fade" id="addRemarqueModal" tabindex="-1" aria-labelledby="addRemarqueModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addRemarqueModal">Ajouter une remarque</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.remarque.store') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Commande<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <select class="form-control radius-8 form-select" id="commande_select_remarque"  name="commande_select_remarque" @error('commande_select_remarque') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror required>
                                        @if(isset($commandes) && count($commandes) > 0 )
                                            @foreach ($commandes as $commande)
                                                <option value="{{ $commande->id }}">{{ $commande->numero_commande}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('commande_select_remarque')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-20" id="remarque-description">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">Description <span class="text-danger-600">*</span></label>
                                    <textarea rows="5" class="form-control radius-8" id="remarque_description" name="remarque_description" placeholder="Entrer la description" required @error('remarque-description') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror></textarea>
                                   <input type="hidden" name="client_remarque_id" id="client_remarque_id" value="{{$client->id}}">
                                    @error('remarque-description')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
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
{{--    Modal update Remarque--}}
    <div class="modal fade" id="updateRemarqueModal" tabindex="-1" aria-labelledby="updateRemarqueModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addRemarqueModal">Modifier une remarque</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.remarque.update') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Commande<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <select class="form-control radius-8 form-select" id="commande_select_remarque_up"  name="commande_select_remarque_up" @error('commande_select_remarque_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror required>
                                        @if(isset($commandes) && count($commandes) > 0 )
                                            @foreach ($commandes as $commande)
                                                <option value="{{ $commande->id }}">{{ $commande->numero_commande }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('commande_select_remarque_up')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-20" id="remarque-description">
                                    <label class="form-label fw-semibold text-primary-light text-sm mb-8">Description <span class="text-danger-600">*</span></label>
                                    <textarea rows="5" class="form-control radius-8" id="remarque_description_up" name="remarque_description_up" placeholder="Entrer la description" required @error('remarque_description_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror></textarea>
                                   <input type="hidden" name="client_remarque_id_up" id="client_remarque_id_up" value="{{$client->id}}">
                                   <input type="hidden" name="remarque_id_up" id="remarque_id_up" value="">
                                    @error('remarque_description_up')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
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
</div>

@endsection
@section('scripts')

    <script src ="{{ asset('assets/js/gfi/clients/detail/form.js') }}"></script>
    <script src ="{{ asset('assets/js/gfi/clients/detail/datatable.js') }}"></script>

@endsection
