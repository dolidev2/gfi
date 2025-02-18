@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Modèles</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Modèles</li>
            </ul>
        </div>

        <div class="card basic-data-table">
            <div class="card-body">
                <table class="table bordered-table mb-0 display responsive nowrap" id="modeleTable" data-page-length='10' width="100%">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Type de modèle</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modeles as $key => $modele)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input" id="modele-input-check" value="{{ $modele->id }}" type="checkbox">
                                </div>
                            </td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $modele->nom}}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $modele->description }}</h6></td>
                            <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $modele->prix }}</h6></td>
                            <td>
                                @if( $modele->statut == env('MODELE_SIMPLE'))
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">unique</h6>
                                @elseif( $modele->statut == env('MODELE_COMPLEXE'))
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">composés</h6>
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
    <script  src="{{ asset('assets/js/gfi/modeles/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/modeles/datatable.js') }}"></script>
@endsection
