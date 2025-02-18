@extends('layouts.app')
@section('heads')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset ('assets/css/lib/slick.css') }}">
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Modifier un modèle</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('modeles.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">
                    <a href="{{ route('modeles.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Modèles
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Modifier un modèle</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-header">
                                <button type="button" class="btn btn-outline-primary border border-primary-600 text-md px-56 py-12 radius-8" id="btn-add-modele">
                                    Ajouter la composition du modèle
                                </button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('modeles.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-20">
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $modele->nom }}" name="nom" >
                                                <input type="hidden" value="{{ $modele->id }}" name="modele_id" >
                                                @error('nom')
                                                    <span class="text-danger-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                                <input type="text" class="form-control radius-8" value="{{ $modele->description}}" name="description" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="prix" class="form-label fw-semibold text-primary-light text-sm mb-8">Prix <span class="text-danger-600">*</span> </label>
                                                <input type="number" step="0.01" class="form-control radius-8" required @error('prix') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $modele->prix}}" name="prix" >
                                                @error('prix')
                                                <span class="text-danger-main fw-semibold">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="cout_montage" class="form-label fw-semibold text-primary-light text-sm mb-8">Coût montage <span class="text-danger-600">*</span>  </label>
                                                <input type="number" step="0.01" class="form-control radius-8" required @error('cout_montage') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $modele->cout_montage}}" name="cout_montage" >
                                                @error('cout_montage')
                                                <span class="text-danger-main fw-semibold">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="cout_decoupage" class="form-label fw-semibold text-primary-light text-sm mb-8">Coût découpage <span class="text-danger-600">*</span>  </label>
                                                <input type="number" step="0.01" class="form-control radius-8" required @error('cout_decoupage') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $modele->cout_decoupage }}" name="cout_decoupage" >
                                                @error('cout_decoupage')
                                                <span class="text-danger-main fw-semibold">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(isset($modele->images) && count($modele->images) >0)
                                            <div class="col-sm-12">
                                                <div class="card p-0 overflow-hidden position-relative radius-12">
                                                    <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                                                        <h6 class="text-lg mb-0">Images du modèle</h6>
                                                    </div>
                                                    <div class="card-body p-0 pagination-carousel dots-style-circle dots-positioned">
                                                        @foreach ($modele->images as $image)
                                                            <div class="gradient-overlay bottom-0 start-0 h-100">
                                                                <img src="{{ asset('images/modeles/'.$image) }}" alt="" width="100%" height="100%" class="w-100 h-100 object-fit-cover">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($modele->statut == env('MODELE_COMPLEXE'))
                                            <div class="col-sm-12 mt-10">
                                                <fieldset >
                                                    <legend>Modèles Composés</legend>
                                                    <div  class="row">
                                                        @foreach($modele->modeles as $key => $obj)
                                                            <div class="col-sm-6 mr-2">
                                                                <label for="modele" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle {{ $key + 1}} </label>
                                                                <input type="text"  class="form-control radius-8 m-2" readonly value="Nom: {{ $obj['nom']}}" >
                                                                <input type="text"  class="form-control radius-8 m-2" readonly value="Prix: {{ $obj['prix']}}" >
                                                                @if($obj['description'] != null)
                                                                    <input type="text"  class="form-control radius-8 m-2" readonly value="Description: {{ $obj['description']}}" >
                                                                @endif
                                                                @if($obj['cout_montage'] != null)
                                                                    <input type="text"  class="form-control radius-8 m-2" readonly value="Coût montage: {{ $obj['cout_montage']}}" >
                                                                @endif
                                                                @if($obj['cout_decoupage'] != null)
                                                                    <input type="text"  class="form-control radius-8 m-2" readonly value="Coût découpage: {{ $obj['cout_decoupage']}}" >
                                                                @endif

                                                                @if($obj['images'] != null)
                                                                    <div class="card p-0 overflow-hidden position-relative radius-12">
                                                                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                                                                            <h6 class="text-lg mb-0">Images du modèle</h6>
                                                                        </div>
                                                                        <div class="card-body p-0 pagination-carousel dots-style-circle dots-positioned">
                                                                            @if(isset($obj['images']) && count($obj['images']) >0)
                                                                                @foreach ($obj['images'] as $img)
                                                                                    <div class="gradient-overlay bottom-0 start-0 h-100">
                                                                                        <img src="{{ asset('images/modeles/'.$img) }}" alt="" width="100%" height="100%" class="w-100 h-100 object-fit-cover">
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </fieldset>
                                            </div>
                                        @endif
                                        <div class="col-sm-12 mt-10">
                                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap"></div>
                                                <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-multiple">
                                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                                    <span class="fw-semibold text-secondary-light">Images</span>
                                                    <input id="upload-file-multiple" @error('imagesModele') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror type="file" name="imagesModele[]" hidden multiple>
                                                    @error('imagesModele')
                                                    <span class="text-danger-main fw-semibold">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-10">
                                            <fieldset id="titre-modele">
                                                <legend>Modèles Composés</legend>
                                                <div id="modele-composition" class="row">

                                                </div>
                                            </fieldset>
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
        var rtlDirection = $('html').attr('dir') === 'rtl';

        // pagination carousel
        $('.pagination-carousel').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 100,
            speed: 600,
            prevArrow: '<button type="button" class="slick-prev"><iconify-icon icon="ic:outline-keyboard-arrow-left" class="menu-icon"></iconify-icon></button>',
            nextArrow: '<button type="button" class="slick-next"><iconify-icon icon="ic:outline-keyboard-arrow-right" class="menu-icon"></iconify-icon></button>',
            rtl: rtlDirection
        });

        // ================================================ Upload Multiple image js Start here ================================================
        const fileInputMultiple = document.getElementById("upload-file-multiple");
        const uploadedImgsContainer = document.querySelector(".uploaded-imgs-container");

        fileInputMultiple.addEventListener("change", (e) => {
            const files = e.target.files;

            Array.from(files).forEach(file => {
                const src = URL.createObjectURL(file);

                const imgContainer = document.createElement('div');
                imgContainer.classList.add('position-relative', 'h-120-px', 'w-120-px', 'border', 'input-form-light', 'radius-8', 'overflow-hidden', 'border-dashed', 'bg-neutral-50');

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('uploaded-img__remove', 'position-absolute', 'top-0', 'end-0', 'z-1', 'text-2xxl', 'line-height-1', 'me-8', 'mt-8', 'd-flex');
                removeButton.innerHTML = '<iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>';

                const imagePreview = document.createElement('img');
                imagePreview.classList.add('w-100', 'h-100', 'object-fit-cover');
                imagePreview.src = src;

                imgContainer.appendChild(removeButton);
                imgContainer.appendChild(imagePreview);
                uploadedImgsContainer.appendChild(imgContainer);

                removeButton.addEventListener('click', () => {
                    URL.revokeObjectURL(src);
                    imgContainer.remove();
                });
            });

            // Clear the file input so the same file(s) can be uploaded again if needed
            // fileInputMultiple.value = '';
        });
        // ================================================ Upload Multiple image js End here  ================================================
        $(document).ready(function() {
            $('#moral').hide();



            $('#titre-modele').hide();
            var x = 0;
            var max_fields = 100;
            var wrapper = $('#modele-composition');
            var add_button = $('#btn-add-modele');

            $(add_button).click(function(e){
                $('#titre-modele').show();
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append(
                        `
                            <div class="col-sm-6 mr-2">
                            <button id="btn-delete-modele" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </button>
                            <label for="modele" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle ${x} </label>
                            <select class="form-control radius-8 form-select" id="modele-select-${x}" required name="modeles[]">
                                <option>-------------------------------------------------</option>
                            </select>
                            </div>
                        `
                    );
                }
                fetch('/modeles/modeles')
                    .then( response => response.json() )
                    .then( response => {
                        if(response.length > 0){
                            response.forEach(obj =>{
                                $('#modele-select-'+x).append(`
                                <option value="${obj.id}">${obj.nom}</option>
                                `);
                            });
                        }
                    });
                $('#modele-select-'+x).select2({
                    width: "100%",
                    height: "100%",
                    language: "fr",
                    placeholder : 'Choisir un modèle'
                });

            });
            $(wrapper).on("click","#btn-delete-modele", function(e){
                e.preventDefault();
                removeRow($(this).parent('div'));
                x--;
            });
            function removeRow(row) {
                $(row).remove();
            }



        });

    </script>
@endsection


