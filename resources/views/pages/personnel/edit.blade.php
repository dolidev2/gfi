@extends('layouts.app')

@section('heads')
    <link href="{{asset('assets/css/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/select2/select2.min.js')}}"></script>
@endsection

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Voir le profil</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('personnels.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Personnel
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Profil</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                    <img src=" {{ ($personnel->image) ? asset('images/personnels/'.$personnel->image):asset('assets/images/user.png') }}"alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                    <div class="pb-24 ms-16 mb-24 me-16  mt-100">
                        <div class="text-center border border-top-0 border-start-0 border-end-0">
                            <h6 class="mb-0 mt-16">{{ $personnel->matricule }}</h6>
                        </div>
                        <div class="mt-24">
                            <h6 class="text-xl mb-16">Informations personnelles</h6>
                            <ul>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nom complet</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{$personnel->nom_complet}}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Adresse</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $personnel->adresse }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Agence</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $personnel->agence->nom }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light"> Contact</span>
                                    <span class="w-70 text-secondary-light fw-medium">: {{ $personnel->contact }}</span>
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
                                    Cnib recto
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                    Cnib verso
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>

                                <form action="{{ route('personnels.update') }}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom complet <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" value="{{ $personnel->nom_complet }}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom complet">
                                                @error('nom')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="contact" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact<span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" value="{{ $personnel->contact }}" @error('contact') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="contact" placeholder="Entrer le contact" required>
                                                @error('contact')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="adresse" class="form-label fw-semibold text-primary-light text-sm mb-8">Adresse</label>
                                                <input type="text" class="form-control radius-8" value="{{ $personnel->adresse }}" name="adresse" placeholder="Entrer l'adresse"/>
                                                <input type="text" class="form-control radius-8" value="{{ $personnel->id }}" name="personnel_id" hidden/>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="agence" class="form-label fw-semibold text-primary-light text-sm mb-8">Agence <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" id="agences-select" required name="agence">
                                                    @if(isset($agences) && count($agences) > 0 )
                                                        @foreach($agences as $agence)
                                                            @if($personnel->agence_id ==  $agence->id)
                                                                <option value="{{ $personnel->agence_id}}" selected >{{$personnel->agence->nom }}</option>
                                                            @else
                                                                <option value="{{ $agence->id}}" >{{$agence->nom }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Upload Image profile -->
                                        <div class="col-sm-12 mb-24 mt-16">
                                            <h6 class="text-md text-primary-light mb-16">CNIB Recto<span class="text-danger-600">*</span></h6>
                                            <div class="avatar-upload">
                                                <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                    <input type='file' id="imageCnibRecto" value="{{old('imageCnibRecto')}}"  @error('imageCnibRecto') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="imageCnibRecto" accept=".png, .jpg, .jpeg, .pdf" hidden>
                                                    @error('imageCnibRecto')
                                                    <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <label for="imageCnibRecto" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                        <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                    </label>
                                                </div>
                                                <div class="avatar-previewCnib">
                                                    <div id="imageCnibRectoPreview"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-24 mt-16">
                                            <h6 class="text-md text-primary-light mb-16">CNIB Verso<span class="text-danger-600">*</span></h6>
                                            <div class="avatar-upload">
                                                <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                    <input type='file' id="imageCnibVerso" value="{{old('imageCnibVerso')}}"  @error('imageCnibVerso') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="imageCnibVerso" accept=".png, .jpg, .jpeg, .pdf" hidden>
                                                    @error('imageCnibVerso')
                                                    <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <label for="imageCnibVerso" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                        <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                    </label>
                                                </div>
                                                <div class="avatar-previewCnib">
                                                    <div id="imageCnibVersoPreview"> </div>
                                                </div>
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
                                <div>
                                    <img src=" {{ ($personnel->cnib_recto) ? asset('images/personnels/'.$personnel->cnib_recto):asset('assets/images/user.png') }}"alt="" class="border br-white border-width-2-px w-500-px h-300-px object-fit-cover">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                <div>
                                    <img src=" {{ ($personnel->cnib_verso) ? asset('images/personnels/'.$personnel->cnib_verso):asset('assets/images/user.png') }}"alt="" class="border br-white border-width-2-px w-500-px h-300-px object-fit-cover">
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
        function readURL(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+preview).css('background-image', 'url('+e.target.result +')');
                    $('#'+preview).hide();
                    $('#'+preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function() {
            readURL(this, 'imagePreview');
        });

        $("#imageCnibRecto").change(function() {
            readURL(this, 'imageCnibRectoPreview');
        });
        $("#imageCnibVerso").change(function() {
            readURL(this, 'imageCnibVersoPreview');
        });


        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            // In your Javascript (external .js resource or <script> tag)
            $('#agences-select').select2({
                width: "100%",
                height: "100%",
                language: "fr",
                placeholder : 'Choisir une agence'
            });
        });
    </script>
@endsection



