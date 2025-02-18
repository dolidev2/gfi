@extends('layouts.app')
@section('content')
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Utilisateurs</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Accueil
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Utilisateurs</li>
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
            <a href="{{ route('users.add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Ajouter un utilisateur
            </a>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0 display responsive nowrap" id="userTable" data-page-length='10' width="100%">
                <thead>
                <tr>
                    <th scope="col">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                        </div>
                    </th>
                    <th scope="col">Image</th>
                    <th scope="col">Nom complet</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Statut</th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" id="user-input-check" value="{{ $user->id }}" type="checkbox">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src=" {{ ($user->image) ? asset('images/users/'.$user->image):asset('assets/images/user.png') }} " width="40" height="40" alt="Photo de profil" class="flex-shrink-0 me-12 radius-8">
                        </div>
                    </td>
                    <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->nom_complet }}</h6></td>
                    <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->contact }}</h6></td>
                    <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->username }}</h6></td>
                    <td><h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->role }}</h6></td>
                    <td>
                        @if($user->status == env('STATUS_ACTIVE'))
                            <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Actif</span>
                        @elseif($user->status == env('STATUS_INACTIVE'))
                            <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Inactif</span>
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
    <script  src="{{ asset('assets/js/gfi/users/form.js') }}"></script>
    <script  src="{{ asset('assets/js/gfi/users/datatable.js') }}"></script>
@endsection
