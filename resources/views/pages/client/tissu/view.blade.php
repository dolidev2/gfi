@extends('layouts.app')

@section('heads')
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{ asset ('assets/css/lib/slick.css') }}">
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Voir un tissu</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Clients
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">
                    <a href="{{ route('clients.view',$client->id) }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Détail
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Voir un tissu</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">   {{$client->nom_complet.'  '.$client->matricule.'  '.$client->contact}}</h6>
                                    <div class="row mb-20">

                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom <span class="text-danger-600">*</span></label>
                                                <input type="text" readonly class="form-control radius-8"  value="{{ $tissu->nom }}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                                <input type="text"readonly class="form-control radius-8" value="{{ $tissu->description }}" >
                                            </div>
                                        </div>
                                        @if(!empty($tissu->quantite))
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="quantite" class="form-label fw-semibold text-primary-light text-sm mb-8">Quantité</label>
                                                    <input type="number"readonly step="0.01" class="form-control radius-8" value="{{  $tissu->quantite }}" >
                                                </div>
                                            </div>
                                            <div class="slider-progress">
                                                <span></span>
                                            </div>
                                        @endif

                                        @if(!empty($tissu->prix))
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="prix" class="form-label fw-semibold text-primary-light text-sm mb-8">Prix</label>
                                                    <input type="number"readonly step="0.01" class="form-control radius-8" value="{{  $tissu->prix }}" >
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty($tissu->commission))
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="commission" class="form-label fw-semibold text-primary-light text-sm mb-8">Commission</label>
                                                    <input type="number"  readonly class="form-control radius-8" value="{{  $tissu->commission }}" >
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-12">
                                            <div class="card p-0 overflow-hidden position-relative radius-12">
                                                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                                                    <h6 class="text-lg mb-0">Images des tissus</h6>
                                                </div>
                                                <div class="card-body p-0 pagination-carousel dots-style-circle dots-positioned">
                                                    @if(isset($tissu->images) && count($tissu->images) >0)
                                                        @foreach ($tissu->images as $image)
                                                            <div class="gradient-overlay bottom-0 start-0 h-100">
                                                                <img src="{{ asset('images/tissus/'.$image->nom) }}" alt="" width="100%" height="100%" class="w-100 h-100 object-fit-cover">
                                                            </div>
                                                        @endforeach
                                                    @endif
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
    <!-- Slick Slider js -->
    <script src="{{ asset ('assets/js/lib/slick.min.js') }}"></script>
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
            autoplaySpeed: 2000,
            speed: 600,
            prevArrow: '<button type="button" class="slick-prev"><iconify-icon icon="ic:outline-keyboard-arrow-left" class="menu-icon"></iconify-icon></button>',
            nextArrow: '<button type="button" class="slick-next"><iconify-icon icon="ic:outline-keyboard-arrow-right" class="menu-icon"></iconify-icon></button>',
            rtl: rtlDirection
        });
        // ================================ Default Slider End ================================
    </script>
@endsection


