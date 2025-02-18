@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Client</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Client</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <button id="btn-view" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                    </button>
                    <button id="btn-edit" type="button" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </button>
                    <button id="btn-delete" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </button>
                </div>
                <a href="{{ route('clients.add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Ajouter un client
                </a>
            </div>
            <div class="card-body">
                <table class="table bordered-table mb-0 display responsive nowrap" id="clientTable" data-page-length='10' width="100%">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </th>
                        <th scope="col">Image</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $key => $client)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" id="client-input-check" value="{{ $client->id }}" type="checkbox">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src=" {{ ($client->image) ? asset('images/clients/'.$client->image):asset('assets/images/user.png') }} "
                                         width="40" height="40" alt="Photo de profil" class="flex-shrink-0 me-12 radius-8">
                                </div>
                            </td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $client->nom_complet }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ date("d/m/Y", strtotime ($client->updated_at)) }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ ($client->contact) }}</h6></td>
                            <td>
                                @if( $client->statut_juridique == env('STATUS_JURIDIQUE_PARTICULIER'))
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Particulier</h6>
                                @endif
                                @if( $client->statut_juridique == env('STATUS_JURIDIQUE_MORAL'))
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Entreprise</h6>
                                @endif
                                @if( $client->statut_juridique == env('STATUS_JURIDIQUE_REVENDEUR'))
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">Revendeur</h6>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script  src="{{ asset('assets/js/gfi/clients/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/clients/datatable.js') }}"></script>
@endsection
