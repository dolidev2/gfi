@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Agences</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Agences</li>
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
                <a href="{{ route('agences.add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Ajouter une agence
                </a>
            </div>
            <div class="card-body">
                <table class="table bordered-table mb-0 display responsive nowrap" id="agenceTable" data-page-length='10' width="100%">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </th>
                        <th scope="col">Image</th>
                        <th scope="col">Contact</th>
                        <th scope="col">adresse</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($agences as $key => $agence)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" id="agence-input-check" value="{{ $agence->id }}" type="checkbox">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src=" {{ ($agence->image) ? asset('images/agences/'.$agence->image):asset('assets/images/user.png') }} "
                                         width="40" height="40" alt="Photo de profil" class="flex-shrink-0 me-12 radius-8">
                                </div>
                            </td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $agence->contact }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $agence->adresse }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $agence->nom }}</h6></td>
                            <td>
                                @if($agence->status == env('STATUS_AGENCE'))
                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Principale</span>
                                @elseif($agence->status == env('STATUS_ANNEXE'))
                                    <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Annexe</span>
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
    <script  src="{{ asset('assets/js/gfi/agences/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/agences/datatable.js') }}"></script>
@endsection
