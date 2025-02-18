
@extends('layouts.app')

@section('heads')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ajouter un client</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Clients
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Ajouter un client</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">Photo de profil</h6>
                                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="matricule" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro de mesure</label>
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
                                                              <input type="text" class="form-control radius-8" value="{{old('bpostale')}}"  name="bpostale" placeholder="Entrer l'adresse postale"/>
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                          <div class="mb-20">
                                                              <label for="ifu" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro IFU</label>
                                                              <input type="text" class="form-control radius-8" value="{{old('ifu')}}"  name="ifu"  placeholder="Entrer le numéro IFU "/>
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                          <div class="mb-20">
                                                              <label for="rccm" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro RCCM</label>
                                                              <input type="text" class="form-control radius-8" value="{{old('rccm')}}" name="rccm" placeholder="Entrer le numéro RCCM"/>
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                          <div class="mb-20">
                                                              <label for="bpostale" class="form-label fw-semibold text-primary-light text-sm mb-8">Boite postale</label>
                                                              <input type="text" class="form-control radius-8" value="{{old('bpostale')}}"  name="bpostale"  placeholder="Entrer l'adresse postale"/>
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                          <div class="mb-20">
                                                              <label for="rimposition" class="form-label fw-semibold text-primary-light text-sm mb-8">Régime d'imposiiton</label>
                                                              <input type="text" class="form-control radius-8" value="{{old('rimposition')}}"  name="rimposition"  placeholder="Entrer le regime d'imposition"/>
                                                          </div>
                                                      </div>
                                                      <div class="col-sm-4">
                                                          <div class="mb-20">
                                                              <label for="dfiscale" class="form-label fw-semibold text-primary-light text-sm mb-8">Division fiscale</label>
                                                              <input type="text" class="form-control radius-8" value="{{old('dfiscale')}}"  name="dfiscale" placeholder="Entrer le regime la division fiscale"/>
                                                          </div>
                                                      </div>
                                              </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="client" class="form-label fw-semibold text-primary-light text-sm mb-8">Recommandation </label>
                                                <select class="form-control radius-8 form-select" id="client-select" name="client" >
                                                    <option>Aucun</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->nom_complet.' <=> '. $client->contact }}</option>
                                                    @endforeach
                                                </select>
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


        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#moral').hide();

            $('#client-select').select2({
                width: "100%",
                height: "100%",
                language: "fr",
                placeholder : 'Choisir un client'
            });
        // In your Javascript (external .js resource or <script> tag)
            $('#agences-select').select2({
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


