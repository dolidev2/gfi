@extends('layouts.app')

@section('heads')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Voir le profil</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Clients
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Profil</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                    <img src=" {{ ($client->image) ? asset('images/clients/'.$client->image):asset('assets/images/user.png') }}"alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                    <div class="pb-24 ms-16 mb-24 me-16  mt-100">
                        <div class="text-center border border-top-0 border-start-0 border-end-0">
                            <h6 class="mb-0 mt-16">{{ $client->matricule }}</h6>
                        </div>
                        <div class="mt-24">
                            <h6 class="text-xl mb-16">Informations personnelles</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nom complet</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{$client->nom_complet}}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Adresse</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $client->adresse }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Agence</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $client->agence->nom }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Contact</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $client->contact }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Type de client</span>
                                    @if( $client->statut_juridique == env('STATUS_JURIDIQUE_PARTICULIER'))
                                        <span class="w-70 text-secondary-light fw-medium">Particulier</span>
                                    @endif
                                    @if( $client->statut_juridique == env('STATUS_JURIDIQUE_MORAL'))
                                        <span class="w-70 text-secondary-light fw-medium">Entreprise</span>
                                    @endif
                                    @if( $client->statut_juridique == env('STATUS_JURIDIQUE_REVENDEUR'))
                                        <span class="w-70 text-secondary-light fw-medium">Revendeur</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body p-24">
                        <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                                    Modifier le profil
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                    Changer le mot de passe
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                    Notifications
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>

                                <form action="{{ route('clients.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Upload Image profile -->
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' id="imageUpload" value="{{old('photoProfile')}}"  @error('photoProfile') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="photoProfile" accept=".png, .jpg, .jpeg" hidden>
                                                @error('photoProfile')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                                <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                    <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End upload Image profile-->
                                    <div class="row mb-20">
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="date_arrivee" class="form-label fw-semibold text-primary-light text-sm mb-8">Date d'arrivée <span class="text-danger-600">*</span></label>
                                                <input type="date" class="form-control radius-8" value="{{ date("Y-m-d", strtotime ($client->updated_at)) }}" @error('date_arrive') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="date_arrive" required >
                                                @error('date_arrive')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom complet <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" value="{{ $client->nom_complet }}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom complet">
                                                @error('nom')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="matricule" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro de mesure</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $client->matricule }}" name="matricule">
                                                <input type="hidden"  class="form-control radius-8" value="{{ $client->id }}" name="client_id">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="contact" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact</label>
                                                <input type="text" class="form-control radius-8" value="{{ $client->contact }}" name="contact" placeholder="Entrer le contact">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="adresse" class="form-label fw-semibold text-primary-light text-sm mb-8">Adresse</label>
                                                <input type="text" class="form-control radius-8" value="{{ $client->adresse }}" name="adresse" placeholder="Entrer l'adresse"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="statut_juridique" class="form-label fw-semibold text-primary-light text-sm mb-8">Type de client  <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" required  name="statut_juridique" id="statut_juridique">
                                                    <option value="{{ env('STATUS_JURIDIQUE_PARTICULIER') }}" {{ old('statut_juridique') == env('STATUS_JURIDIQUE_PARTICULIER') ? 'selected' : '' }}>Particulier</option>
                                                    <option value="{{ env('STATUS_JURIDIQUE_MORAL') }}" {{ old('statut_juridique') == env('STATUS_JURIDIQUE_MORAL') ? 'selected' : '' }}>Entreprise</option>
                                                    <option value="{{ env('STATUS_JURIDIQUE_COMMERCIAL') }}" {{ old('statut_juridique') == env('STATUS_JURIDIQUE_COMMERCIAL') ? 'selected' : '' }}>{{ env('STATUS_JURIDIQUE_COMMERCIAL') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="moral">
                                            <fieldset>
                                                <legend class="form-label fw-semibold text-primary-light text-sm mb-8"> Inofrmations sur l'entreprise</legend>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="mb-20">
                                                            <label for="bpostale" class="form-label fw-semibold text-primary-light text-sm mb-8">Boite postale</label>
                                                            <input type="text" class="form-control radius-8" value="{{ $client->boite_postale}}"   name="bpostale" placeholder="Entrer l'adresse postale"/>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-20">
                                                            <label for="ifu" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro IFU</label>
                                                            <input type="text" class="form-control radius-8" value="{{ $client->ifu}}" name="ifu"  placeholder="Entrer le numéro IFU "/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-20">
                                                            <label for="rccm" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro RCCM</label>
                                                            <input type="text" class="form-control radius-8" value="{{ $client->rccm}}"   name="rccm" placeholder="Entrer le numéro RCCM"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="mb-20">
                                                            <label for="rimposition" class="form-label fw-semibold text-primary-light text-sm mb-8">Régime d'imposiiton</label>
                                                            <input type="text" class="form-control radius-8" value="{{ $client->regime_imposition }}"  name="rimposition"  placeholder="Entrer le regime d'imposition"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-20">
                                                            <label for="dfiscale" class="form-label fw-semibold text-primary-light text-sm mb-8">Division fiscale</label>
                                                            <input type="text" class="form-control radius-8" value="{{ $client->division_fiscale }}" name="dfiscale" placeholder="Entrer le regime la division fiscale"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="client" class="form-label fw-semibold text-primary-light text-sm mb-8">Recommandation </label>
                                                <select class="form-control radius-8 form-select" id="client-select" name="client" >
                                                    <option>Aucun</option>
                                                @foreach($clients as $obj)
                                                    @if( $client->id ==  $obj->id)
                                                        <option value="{{ $client->id }}" selected>{{ $client->nom_complet.' <=> '. $client->contact }}</option>
                                                    @else
                                                        <option value="{{ $obj->id }}">{{ $obj->nom_complet.' <=> '. $obj->contact }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="agence" class="form-label fw-semibold text-primary-light text-sm mb-8">Agence <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" id="agence-select" required name="agence">

                                                    @foreach($agences as $agence)
                                                        @if( $client->agence_id ==  $agence->id)
                                                            <option value="{{ $client->agence_id}}" selected >{{$client->agence->nom }}</option>
                                                        @else
                                                        <option value="{{ $agence->id}}" >{{$agence->nom }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
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

                            <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                                <form action ="{{route('users.update_password')}}" method="POST" >
                                    @csrf
                                    <div class="mb-20">
                                        <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Mot de passe <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control radius-8" id="password" name="password" @error('password') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror placeholder="Entrer le mot de passe*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#password"></span>
                                            @error('password')
                                            <span class="text-danger-main fw-semibold">
                                              {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmez le mot de passe <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control radius-8" id="confirm-password" name="cpassword" @error('cpassword') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror placeholder="Confirmez le mot de passe*">
                                            <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                            @error('password')
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

                            <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Company News</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Push Notification</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Weekly News Letters</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Near you</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Orders Notifications</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });


        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {

            $('#moral').hide();

            if(  $('#statut_juridique').val() == 'moral'){
                $('#moral').show();
            }

            $('#client-select').select2({
                width: "100%",
                height: "100%",
                language: "fr",
                placeholder : 'Choisir un client'
            });
            // In your Javascript (external .js resource or <script> tag)
            $('#agence-select').select2({
                width: "100%",
                height: "100%",
                language: "fr",
                placeholder : 'Choisir une agence'
            });

            //Statut juridique entrprise
            $('#statut_juridique').change(function() {
                if ($(this).val() == 'moral') {
                    $('#moral').show();
                } else {
                    $('#moral').hide();
                }
            });


        });


    </script>
@endsection


