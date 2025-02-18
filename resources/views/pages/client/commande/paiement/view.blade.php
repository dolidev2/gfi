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
                    <a href="{{ route('clients.view', $client->id) }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Commande
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Paiement</li>
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
                            <table class="table bordered-table mb-0 display responsive nowrap" id="commandePaiementTable" data-page-length='10' width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Somme</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Mode de paiement</th>
                                        <th scope="col">Numéro du reçu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($paiements) && count($paiements) > 0 )
                                        @foreach ($paiements as $paiement)
                                            <tr>
                                                <td>
                                                    <div class="form-check style-check d-flex align-items-center">
                                                        <input class="form-check-input" id="paiement-input-check" value="{{ $paiement->id }}" type="checkbox">
                                                    </div>
                                                </td>
                                                <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{date("d/m/Y", strtotime($paiement->created_at))}}</h6></td>
                                                <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $paiement->montant }}</h6></td>
                                                <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $paiement->description }}</h6></td>
                                                <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $paiement->mode_paiement }}</h6></td>
                                                <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $paiement->numero_paiement }}</h6></td>
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
    {{--    Add paiement modal--}}
    <div class="modal fade" id="addPaiementModal" tabindex="-1" aria-labelledby="addPaiementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addCommandeModalLabel">Ajouter un paiement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.commande.paiement.store') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de paiement<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" id="date_paiement" type="text" name="date_paiement" placeholder="{{ date('d/m/Y') }}" required @error('date_paiement') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_paiement')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Montant à verser <span class="text-danger-600">*</span></label>
                                <input type="number" step="0.01" class="form-control radius-8" required @error('montant') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{old('montant')}}" name="montant" >
                                @error('montant')
                                <span class="text-danger-main fw-semibold">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                <input type="textarea" step="" class="form-control radius-8" value="{{old('description')}}" name="description" >
                                <input type="hidden" name="client_id" value="{{$client->id}}">
                                <input type="hidden" name="commande_id" value="{{$commande->id}}">
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Mode de paiement <span class="text-danger-600">*</span></label>
                                <select class="form-control radius-8" name="mode_paiement" @error('mode_paiement') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror required>
                                    @error('mode_paiement')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <option value="{{ env('MODE_PAIEMENT_ESPECE') }}" selected>Espèce</option>
                                    <option value="{{ env('MODE_PAIEMENT_CHEQUES') }}">Chèques</option>
                                    <option value="{{ env('MODE_PAIEMENT_MOBILE_MONEY') }}">Mobile Money</option>
                                    <option value="{{ env('MODE_PAIEMENT_VIREMENT') }}">Virement Bancaire</option>
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
    {{--    Update paiement modal--}}
    @if(isset($paiement)  )
        <div class="modal fade" id="updatePaiementModal" tabindex="-1" aria-labelledby="updatePaiementModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="addCommandeModalLabel">Modifier un paiement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <form action="{{ route('client.commande.paiement.update') }}" method="POST">
                        @csrf()
                        <div class="row">
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Date de paiement<span class="text-danger-600">*</span></label>
                                <div class=" position-relative">
                                    <input class="form-control radius-8 bg-base" id="date_paiement_up" type="text" name="date_paiement_up" value="{{ date("d/m/Y", strtotime($paiement->created_at)) }}" @error('date_paiement_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                                    @error('date_paiement_up')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Montant à verser <span class="text-danger-600">*</span></label>
                                <input type="number" step="0.01" class="form-control radius-8" required @error('montant_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $paiement->montant }}" name="montant_up" >
                                @error('montant_up')
                                <span class="text-danger-main fw-semibold">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                <input type="textarea" step="" class="form-control radius-8" value="{{ $paiement->description }}" name="description_up" >
                                <input type="hidden" name="client_id_up" value="{{$client->id}}">
                                <input type="hidden" name="commande_id_up" value="{{$commande->id}}">
                                <input type="hidden" name="paiement_id" value="{{$paiement->id}}">
                            </div>
                            <div class="col-12 mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Mode de paiement <span class="text-danger-600">*</span></label>
                                <select class="form-control radius-8" name="mode_paiement_up" @error('mode_paiement_up') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror required>
                                    @error('mode_paiement_up')
                                    <span class="text-danger-main fw-semibold">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    @if($paiement->mode_paiement == env('MODE_PAIEMENT_ESPECE'))
                                        <option value="{{ env('MODE_PAIEMENT_ESPECE') }}" selected>Espèce</option>
                                        <option value="{{ env('MODE_PAIEMENT_CHEQUES') }}">Chèques</option>
                                        <option value="{{ env('MODE_PAIEMENT_MOBILE_MONEY') }}">Mobile Money</option>
                                        <option value="{{ env('MODE_PAIEMENT_VIREMENT') }}">Virement Bancaire</option>
                                    @elseif($paiement->mode_paiement == env('MODE_PAIEMENT_CHEQUES'))
                                        <option value="{{ env('MODE_PAIEMENT_CHEQUES') }}" selected>Chèques</option>
                                        <option value="{{ env('MODE_PAIEMENT_ESPECE') }}">Espèce</option>
                                        <option value="{{ env('MODE_PAIEMENT_MOBILE_MONEY') }}">Mobile Money</option>
                                        <option value="{{ env('MODE_PAIEMENT_VIREMENT') }}">Virement Bancaire</option>
                                    @elseif($paiement->mode_paiement == env('MODE_PAIEMENT_MOBILE_MONEY'))
                                        <option value="{{ env('MODE_PAIEMENT_MOBILE_MONEY') }}" selected>Mobile Money</option>
                                        <option value="{{ env('MODE_PAIEMENT_CHEQUES') }}" >Chèques</option>
                                        <option value="{{ env('MODE_PAIEMENT_ESPECE') }}">Espèce</option>
                                        <option value="{{ env('MODE_PAIEMENT_VIREMENT') }}">Virement Bancaire</option>
                                    @elseif($paiement->mode_paiement == env('MODE_PAIEMENT_VIREMENT'))
                                        <option value="{{ env('MODE_PAIEMENT_VIREMENT') }}" selected>Virement Bancaire</option>
                                        <option value="{{ env('MODE_PAIEMENT_MOBILE_MONEY') }}" >Mobile Money</option>
                                        <option value="{{ env('MODE_PAIEMENT_CHEQUES') }}" >Chèques</option>
                                        <option value="{{ env('MODE_PAIEMENT_ESPECE') }}">Espèce</option>
                                    @endif
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
    @endif
</div>

@endsection
@section('scripts')
    <script  src="{{ asset('assets/js/gfi/clients/paiement/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/clients/paiement/datatable.js') }}"></script>
@endsection
