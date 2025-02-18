
@extends('layouts.app')

@section('heads')
    <link href="{{asset('assets/css/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/select2/select2.min.js')}}"></script>
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ajouter un collaborateur</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('personnels.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Personnels
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ajouter un collaborateur</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>
                                <form action="{{ route('personnels.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="date_arrive" class="form-label fw-semibold text-primary-light text-sm mb-8">Date d'arrivée <span class="text-danger-600">*</span></label>
                                                <input type="date" class="form-control radius-8" value="{{old('date_arrive')}}" @error('date_arrive') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="date_arrive" required >
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
                                                <input type="text" class="form-control radius-8" value="{{old('nom_complet')}}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom complet">
                                                @error('nom')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="matricule" class="form-label fw-semibold text-primary-light text-sm mb-8">Matricule</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $matricule }}" name="matricule">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="contact" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact</label>
                                                <input type="text" class="form-control radius-8" value="{{old('contact')}}"  name="contact" placeholder="Entrer le contact">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="adresse" class="form-label fw-semibold text-primary-light text-sm mb-8">Adresse</label>
                                                <input type="text" class="form-control radius-8" value="{{old('adresse')}}" name="adresse" placeholder="Entrer l'adresse"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="agence" class="form-label fw-semibold text-primary-light text-sm mb-8">Agence <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" id="agences-select" required name="agence">
                                                    @if(isset($agences) && count($agences) > 0 )
                                                        @foreach($agences as $agence)
                                                            <option value="{{ $agence->id}}" >{{$agence->nom }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Upload Image profile -->
                                        <div class="col-sm-6 mb-24 mt-16">
                                            <h6 class="text-md text-primary-light mb-16">CNIB Recto</h6>
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
                                        <div class="col-sm-6 mb-24 mt-16">
                                            <h6 class="text-md text-primary-light mb-16">CNIB Verso</h6>
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


