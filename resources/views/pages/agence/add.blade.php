@extends('layouts.app')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ajouter une agence</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('agences.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Agences
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ajouter une agence</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">Logo agence</h6>
                                <form action="{{ route('agences.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control radius-8" value="{{old('nom')}}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom de l'agence">
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
                                                <input type="text" class="form-control radius-8" value="{{old('contact')}}" @error('contact')  class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="contact" placeholder="Entrer le contact">
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
                                                <input type="text" class="form-control radius-8" value="{{old('adresse')}}"  @error('adresse') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="adresse" placeholder="Entrer l'adresse de l'agence"/>
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
                                                <input type="email" class="form-control radius-8" value="{{old('email')}}"  @error('email') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="email" placeholder="Entrer l'email"/>
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
                                                <select class="form-control radius-8 form-select" value="{{old('status')}}" required @error('status') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="status">
                                                    @error('status')
                                                    <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <option selected disabled>--------------------- </option>
                                                    <option value="{{ env('STATUS_AGENCE') }}" {{ old('status') ==  env('STATUS_AGENCE')  ? 'selected' : '' }}>Principale </option>
                                                    <option value="{{ env('STATUS_ANNEXE') }}" {{ old('status') ==  env('STATUS_ANNEXE')  ? 'selected' : '' }}>Annexe </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="bpostal" class="form-label fw-semibold text-primary-light text-sm mb-8">Boite postale</label>
                                                <input type="text" class="form-control radius-8" id="bpostal" @error('bpostal') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="bpostale" placeholder="Entrer la boite postale">
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
                                                <input type="ifu" class="form-control radius-8" value="{{old('ifu')}}"  @error('ifu') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="ifu" placeholder="Entrer le numéro IFU">
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
                                                <input  type="text" class="form-control radius-8 " value="{{old('rccm')}}" @error('rccm') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="rccm" placeholder="Entrer le numéro RCCM">
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
                                                <input type="text" class="form-control radius-8" id="dfiscale" @error('dfiscale') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="dfiscale" placeholder="Entrer la division fiscale">
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
                                                <input type="text" class="form-control radius-8" id="rimposition" @error('rimposition') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="rimposition" placeholder="Entrer le regime d'imposition">
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


    </script>
@endsection
