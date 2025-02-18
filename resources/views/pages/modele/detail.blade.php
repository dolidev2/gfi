@extends('layouts.app')
@section('heads')
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset ('assets/css/lib/slick.css') }}">
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Voir plus sur le modèle</h6>
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
                <li class="fw-medium">Voir plus sur le modèle</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <div class="row mb-20">
                                    <div class="col-sm-4">
                                        <div class="mb-20">
                                            <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom</label>
                                            <input type="text"  readonly class="form-control radius-8"  value="{{ $modele->nom}}"  >
                                            <input type="hidden" id="modele_id" value="{{$modele->id}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-20">
                                            <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                            <input type="text" readonly class="form-control radius-8" value="{{ $modele->description }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-20">
                                            <label for="prix" class="form-label fw-semibold text-primary-light text-sm mb-8">Prix <span class="text-danger-600">*</span> </label>
                                            <input type="number" step="0.01" class="form-control radius-8" readonly value="{{ $modele->prix }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-20">
                                            <label for="cout_montage" class="form-label fw-semibold text-primary-light text-sm mb-8">Coût montage <span class="text-danger-600">*</span>  </label>
                                            <input type="number" step="0.01" class="form-control radius-8" readonly value="{{ $modele->cout_montage }}" >
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-20">
                                            <label for="cout_decoupage" class="form-label fw-semibold text-primary-light text-sm mb-8">Coût découpage <span class="text-danger-600">*</span>  </label>
                                            <input type="number" step="0.01" class="form-control radius-8" readonly value="{{ $modele->cout_decoupage }}" >
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
                                            <fieldset id="titre-modele">
                                                <legend>Modèles Composés</legend>
                                                <div id="modele-composition" class="row">
                                                    @foreach($modele->modeles as $key => $obj)
                                                        <div class="col-sm-6 mr-2">
                                                            <label for="modele" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle {{ $key + 1}} </label>
                                                            <button id="btn-delete-modele" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                                <input type="hidden" id="id_modele" value="{{$obj['id']}}">
                                                            </button>
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
        // When the page is ready, run this code
        $(document).ready(function () {

            var btn_delete_modele = document.querySelectorAll('#btn-delete-modele');
            btn_delete_modele.forEach(event => {
                event.addEventListener('click', function () {
                    var id_modele = event.children[1].value;
                    var modele_id = document.getElementById("modele_id").value;
                    Swal.fire({
                        title: "Voulez vous vraiment supprimez ?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Supprimer",
                        denyButtonText: "Annuler",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            fetch('/modeles/'+modele_id+'/delete/' + id_modele)
                                .then(response => response.json())
                                .then(response => {
                                    if (response == 0) {
                                        Swal.fire({
                                            title: 'Bravo',
                                            text: 'Le modèle a été supprimé avec succès',
                                            icon: 'success',
                                        });
                                    } else if (response == 1) {
                                        Swal.fire({
                                            title: 'Erreur',
                                            text: 'Vous n\'êtes pas autorisé à supprimer l\'offre',
                                            icon: 'error',
                                        });
                                    }
                                });
                            setTimeout(function () {
                                location.reload();
                            }, 3000); //3s
                            // refresh page
                        }
                    });
                });
            });
        });
    </script>
@endsection


