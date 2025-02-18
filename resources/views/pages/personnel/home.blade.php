@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Personnels</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('personnels.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Personnels</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <button id="btn-edit" type="button" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </button>
                    <button id="btn-delete" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </button>
                </div>
                <a href="{{ route('personnels.add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Ajouter un collaborateur
                </a>
            </div>
            <div class="card-body">
                <table class="table bordered-table mb-0 display responsive nowrap" id="personnelTable" data-page-length='10' width="100%">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </th>
                        <th scope="col">Image</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Statut</th>
                        <th scope="col">agence</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personnels as $key => $personnel)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" id="personnel-input-check" value="{{ $personnel->id }}" type="checkbox">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src=" {{ ($personnel->image) ? asset('images/personnels/'.$personnel->image):asset('assets/personnels/user.png') }} "
                                         width="40" height="40" alt="Photo de profil" class="flex-shrink-0 me-12 radius-8">
                                </div>
                            </td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $personnel->matricule }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $personnel->nom_complet }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ ($personnel->contact) }}</h6></td>
                            @if( $personnel->statut == env('STATUS_SUCCESS'))
                                <td><span class="badge bg-success"> Actif</span></td>
                            @else
                                <td><span class="badge bg-danger"> Inactif</span></td>
                            @endif
                            <td>
                              <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $personnel->agence->nom }}</h6>
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
    <script  src="{{ asset('assets/js/gfi/personnels/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/personnels/datatable.js') }}"></script>
@endsection
