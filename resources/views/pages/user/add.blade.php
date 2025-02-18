@extends('layouts.app')

@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ajouter un utilisateur</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('users.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Utilisateurs
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ajouter un utilisateur</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>
                                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control radius-8" value="{{old('nom_complet')}}" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="nom" required placeholder="Entrer le nom complet">
                                                @error('nom')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
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
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="username" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom d'utilisateur<span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" value="{{old('username')}}"  @error('username') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="username" required placeholder="Entrer le nom d'utilisateur"/>
                                                @error('username')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">Rôle  <span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" value="{{old('role')}}" required @error('role') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="role">
                                                    @error('role')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <option selected disabled>--------------------- </option>
                                                    <option value="{{ env('ROLE_USER') }}" {{ old('role') == env('ROLE_USER') ? 'selected' : '' }}>secretaire </option>
                                                    <option value="{{ env('ROLE_ADMIN') }}" {{ old('role') == env('ROLE_ADMIN') ? 'selected' : '' }}>administrateur</option>
                                                    <option value="{{ env('ROLE_SUPER_ADMIN') }}" {{ old('role') == env('ROLE_SUPER_ADMIN') ? 'selected' : '' }}>super_administrateur</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="password" class="form-label fw-semibold text-primary-light text-sm mb-8">Mot de passe<span class="text-danger-600">*</span></label>
                                                <input type="password" class="form-control radius-8" id="password" @error('password') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="password" required placeholder="Entrer le mot de passe">
                                                @error('password')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="cpassword" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmer le mot de passe <span class="text-danger-600">*</span></label>
                                                <input type="password" class="form-control radius-8" id="cpassword" @error('cpassword') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="cpassword" required placeholder="Confirmer le mot de passe">
                                                @error('cpassword')
                                                <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-20">
                                                <label for="agence" class="form-label fw-semibold text-primary-light text-sm mb-8">Agence<span class="text-danger-600">*</span> </label>
                                                <select class="form-control radius-8 form-select" required @error('agence') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror name="agence">
                                                    @error('agence')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                    <option selected disabled>--------------------- </option>
                                                    @foreach($agences as $agence)
                                                        <option value="{{$agence->id}}" {{old('agence') == $agence->id ? 'selected' : '' }}>{{$agence->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 ">
                                            <!-- Upload Image CNIB recto -->
                                            <label for="depart" class="form-label fw-semibold text-primary-light text-sm mb-8">CNIB recto </label>
                                            <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                <div class="uploaded-img d-none position-relative h-144-px w-400-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                    <button type="button" class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                                        <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                                                    </button>
                                                    <img id="uploaded-img__preview" class="w-400 h-120 object-fit-cover" src="{{asset('assets/images/user.png')}}" alt="image">
                                                </div>

                                                <label class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file">
                                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                                    <span class="fw-semibold text-secondary-light"> </span>
                                                    <input id="upload-file" type="file" value="{{old('photoCnibRecto')}}" name="photoCnibRecto" @error('photoCnibRecto') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror hidden>
                                                    @error('photoCnibRecto')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                </label>
                                            </div>
                                            <!-- End upload Image CNIB recto-->
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Upload Image CNIB verso -->
                                            <label for="depart" class="form-label fw-semibold text-primary-light text-sm mb-8">CNIB verso </label>
                                            <div class="upload-image-wrapper-verso d-flex align-items-center gap-3">
                                                <div class="uploaded-img-verso d-none position-relative h-144-px w-400-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                    <button type="button" class="uploaded-img__remove-verso position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                                        <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                                                    </button>
                                                    <img id="uploaded-img__preview-verso" class="w-400 h-120 object-fit-cover" src="{{asset('assets/images/user.png')}}" alt="image">
                                                </div>

                                                <label class="upload-file-verso h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-verso">
                                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                                    <span class="fw-semibold text-secondary-light"> </span>
                                                    <input id="upload-file-verso" type="file" value="{{old('photoCnibVerso')}}" name="photoCnibVerso" @error('photoCnibVerso') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror hidden>
                                                    @error('photoCnibVerso')
                                                      <span class="text-danger-main fw-semibold">
                                                          {{ $message }}
                                                      </span>
                                                    @enderror
                                                </label>
                                            </div>
                                            <!-- End upload Image CNIB recto-->
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

    </script>
@endsection
