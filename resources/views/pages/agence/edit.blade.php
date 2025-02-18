@extends('layouts.app')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Agence</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('agences.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Agences
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Profil</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                    <img src=" {{ ($agence->image) ? asset('images/agences/'.$agence->image):asset('assets/images/user.png') }}"alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                    <div class="pb-24 ms-16 mb-24 me-16  mt-100">
                        <div class="text-center border border-top-0 border-start-0 border-end-0">
                            <h6 class="mb-0 mt-16">{{ $agence->nom }}</h6>
                        </div>
                        <div class="mt-24">
                            <h6 class="text-xl mb-16">Informations personnelles</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nom </span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{$agence->nom}}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Contact</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $agence->contact }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Boite postale</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $agence->boite_postale }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Statut</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $agence->status }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $agence->email }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Adresse</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $agence->adresse }}</span>
                                </li>
                                <li>
                                <span class="w-35 text-md fw-semibold text-primary-light"> Numéro IFU</span>
                                    <span class="w-65 text-secondary-light fw-medium">: {{ $agence->ifu }}</span>
                                </li>
                                <li>
                                <span class="w-35 text-md fw-semibold text-primary-light"> Numéro RCCM</span>
                                    <span class="w-65 text-secondary-light fw-medium">: {{ $agence->rccm }}</span>
                                </li>
                                <li>
                                <span class="w-35 text-md fw-semibold text-primary-light"> Division fiscale</span>
                                    <span class="w-65 text-secondary-light fw-medium">: {{ $agence->division_fiscale }}</span>
                                </li>
                                <li>
                                <span class="w-35 text-md fw-semibold text-primary-light"> Regime d'imposition</span>
                                    <span class="w-65 text-secondary-light fw-medium">: {{ $agence->regime_imposiiton }}</span>
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
                                    Modifier l'agence
                                </button>
                            </li>
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">--}}
{{--                                    Changer le mot de passe--}}
{{--                                </button>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">--}}
{{--                                    Notifications--}}
{{--                                </button>--}}
{{--                            </li>--}}
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>
                                <form action="{{ route('agences.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Upload Image profile -->
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' id="imageUpload" name="logoProfil" @error('logoProfil') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror accept=".png, .jpg, .jpeg" hidden>
                                                @error('logoProfil')
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
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom<span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" value="{{ $agence->nom }}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom de l'agence">
                                                <input type="hidden" class="form-control radius-8" id="agence_id" name="agence_id" value="{{ $agence->id }}">
                                                @error('nom')
                                                <span class="text-danger-main fw-semibold">
                                                      {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="contact" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact</label>
                                                <input type="text" class="form-control radius-8" value="{{ $agence->contact }}" @error('contact')  class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="contact" placeholder="Entrer le contact">
                                                @error('contact')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="adresse" class="form-label fw-semibold text-primary-light text-sm mb-8">Adresse</label>
                                                <input type="text" class="form-control radius-8" value="{{ $agence->nom }}"  @error('adresse') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="adresse" placeholder="Entrer l'adresse de l'agence"/>
                                                @error('adresse')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email</label>
                                                <input type="email" class="form-control radius-8" value="{{ $agence->email }}"  @error('email') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="email" placeholder="Entrer l'email"/>
                                                @error('email')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Statut  <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select"  required @error('status') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="status">
                                                    @error('status')
                                                    <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <option selected disabled>--------------------- </option>
                                                    <option value="{{ env('STATUS_AGENCE') }}" {{ $agence->status ==  env('STATUS_AGENCE')  ? 'selected' : '' }}>Principale </option>
                                                    <option value="{{ env('STATUS_ANNEXE') }}" {{ $agence->status ==  env('STATUS_ANNEXE')  ? 'selected' : '' }}>Annexe </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="bpostal" class="form-label fw-semibold text-primary-light text-sm mb-8">Boite postale</label>
                                                <input type="text" class="form-control radius-8" id="bpostal" value="{{ $agence->boite_postale }}" @error('bpostal') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="bpostale" placeholder="Entrer la boite postale">
                                                @error('bpostal')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="ifu" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro IFU</label>
                                                <input type="ifu" class="form-control radius-8" alue="{{ $agence->ifu }}" @error('ifu') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="ifu" placeholder="Entrer le numéro IFU">
                                                @error('ifu')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="rccm" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro RCCM </label>
                                                <input  type="text" class="form-control radius-8 " value="{{ $agence->rccm }}" @error('rccm') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="rccm" placeholder="Entrer le numéro RCCM">
                                                @error('rccm')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="dfiscale" class="form-label fw-semibold text-primary-light text-sm mb-8">Division fiscale</label>
                                                <input type="text" class="form-control radius-8" id="dfiscale" value="{{ $agence->division_fiscale }}" @error('dfiscale') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="dfiscale" placeholder="Entrer la division fiscale">
                                                @error('dfiscale')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="rimposition" class="form-label fw-semibold text-primary-light text-sm mb-8">Régime d'imposition</label>
                                                <input type="text" class="form-control radius-8" value="{{ $agence->regime_imposition }}" id="rimposition" @error('rimposition') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="rimposition" placeholder="Entrer le regime d'imposition">
                                                @error('rimposition')
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

        const fileInput = document.getElementById("upload-file");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");

        fileInput.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                imagePreview.src = src;
                uploadedImgContainer.classList.remove('d-none');
            }
        });
        removeButton.addEventListener("click", () => {
            imagePreview.src = "";
            uploadedImgContainer.classList.add('d-none');
            fileInput.value = "";
        });

        const fileInputVerso = document.getElementById("upload-file-verso");
        const imagePreviewVerso = document.getElementById("uploaded-img__preview-verso");
        const uploadedImgContainerVerso = document.querySelector(".uploaded-img-verso");
        const removeButtonVerso = document.querySelector(".uploaded-img__remove-verso");

        fileInputVerso.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const srcv = URL.createObjectURL(e.target.files[0]);
                imagePreviewVerso.src = srcv;
                uploadedImgContainerVerso.classList.remove('d-none');
            }
        });
        removeButtonVerso.addEventListener("click", () => {
            imagePreviewVerso.src = "";
            uploadedImgContainerVerso.classList.add('d-none');
            fileInputVerso.value = "";
        });

        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on('click', function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle('.toggle-password');
        // ========================= Password Show Hide Js End ===========================
    </script>
@endsection


