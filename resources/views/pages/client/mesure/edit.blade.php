@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Modifier une mesure</h6>
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
                <li class="fw-medium">Modifier une mesure</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">   {{$client->nom_complet.'  '.$client->matricule.'  '.$client->contact}}</h6>
                                <form action="{{ route('client.mesure.update') }}" method="POST">
                                    @csrf
                                    <div class="row mb-20">
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="sexe" class="form-label fw-semibold text-primary-light text-sm mb-8">Sexe <span class="text-danger-600">*</span></label>
                                                <select class="form-control radius-8 form-select" required  name="sexe" id="sexe">
                                                    <option value="{{ env('SEXE_MASCULIN') }}" {{ $mesure->sexe == env('SEXE_MASCULIN') ? 'selected' : '' }}>{{ env('SEXE_MASCULIN') }}</option>
                                                    <option value="{{ env('SEXE_FEMININ') }}" {{ $mesure->sexe== env('SEXE_FEMININ') ? 'selected' : '' }}>{{ env('SEXE_FEMININ') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="epaule" class="form-label fw-semibold text-primary-light text-sm mb-8">Epaule</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->epaule }}" name="epaule" >
                                                <input type="hidden" class="form-control radius-8" value="{{ $client->id }}" name="client_id" >
                                                <input type="hidden" class="form-control radius-8" value="{{ $mesure->id }}" name="mesure_id" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="largeur_epaule" class="form-label fw-semibold text-primary-light text-sm mb-8">Largeur Epaule </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_epaule}}" name="longueur_epaule" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="carrure" class="form-label fw-semibold text-primary-light text-sm mb-8">Carrure </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->carrure}}" name="carrure" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Poitrine</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->poitrine}}" name="poitrine" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="dos" class="form-label fw-semibold text-primary-light text-sm mb-8">Dos</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->dos}}" name="dos" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_taille" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour de Taille</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->tour_taille}}" name="tour_taille" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="ceinture" class="form-label fw-semibold text-primary-light text-sm mb-8">Ceinture </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->ceinture}}" name="ceinture" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="bassin" class="form-label fw-semibold text-primary-light text-sm mb-8">Bassin</label>
                                                <input type="text" class="form-control radius-8" value="{{old('bassin')}}" name="bassin" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="cuisse" class="form-label fw-semibold text-primary-light text-sm mb-8">Cuisse</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->cuisse}}" name="cuisse" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_genou" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour des genoux </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->tour_genou}}" name="tour_genou" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="bas" class="form-label fw-semibold text-primary-light text-sm mb-8">Bas </label>
                                                <input type="text" class="form-control radius-8" value="{{$mesure->bas}}" name="bas" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="cole" class="form-label fw-semibold text-primary-light text-sm mb-8">Cole </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->cole}}" name="cole" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour de manche</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->tour_manche}}" name="tour_manche" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur manche</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_manche}}" name="longueur_manche" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_taille" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur de taille </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_taille}}" name="longueur_taille" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_chemise" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur chemise</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_chemise}}" name="longueur_chemise" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_tunique" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur tunique</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_tunique}}" name="longueur_tunique" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_gilet" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur gilet </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_gilet}}" name="longueur_gilet" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_veste" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur veste</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_veste}}" name="longueur_veste" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_genou" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur genoux</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->tour_manche}}" name="tour_manche" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur manche</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_genou}}" name="longueur_genou" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_pantalon" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur pantalon </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_pantalon}}" name="longueur_pantalon" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_pantacourt" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur pantacourt</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_pantacourt}}" name="longueur_pantacourt" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="entre_jambe" class="form-label fw-semibold text-primary-light text-sm mb-8">Entre jambe</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->entre_jambe}}" name="entre_jambe" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="frappe" class="form-label fw-semibold text-primary-light text-sm mb-8">Frappe</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->frappe}}" name="frappe" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="chapeau" class="form-label fw-semibold text-primary-light text-sm mb-8">Chapeau </label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->chapeau}}" name="chapeau" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="sexe_feminin1">
                                            <div class="mb-20">
                                                <label for="longueur_jupe" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur jupe</label>
                                                <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_jupe}}" name="longueur_jupe" >
                                            </div>
                                        </div>

                                        <div id="sexe_feminin" class="row">
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="ecart_pince_poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Ecart pince poitrine</label>
                                                    <input type="text" class="form-control radius-8" value="{{ $mesure->ecart_pince_poitrine}}" name="ecart_pince_poitrine" >
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="longueur_haut" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur haut</label>
                                                    <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_haut}}" name="longueur_haut" >
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="longueur_robe" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur Robe</label>
                                                    <input type="text" class="form-control radius-8" value="{{ $mesure->longueur_robe}}" name="longueur_robe" >
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="hauteur_poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Hauteur Poitrine </label>
                                                    <input type="text" class="form-control radius-8" value="{{ $mesure->hauteur_poitrine}}" name="hauteur_poitrine" >
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
        $(document).ready(function() {
            var sexe = $('#sexe').val();
            if(sexe == 'Masculin'){
                $('#sexe_feminin').hide();
                $('#sexe_feminin1').hide();
            }else{
                $('#sexe_feminin').show();
                $('#sexe_feminin1').show();
            }
            $('#sexe').change(function(){
                var sexe = $('#sexe').val();
                if(sexe == 'Masculin'){
                    $('#sexe_feminin').hide();
                    $('#sexe_feminin1').hide();
                }else{
                    $('#sexe_feminin').show();
                    $('#sexe_feminin1').show();
                }
            });
        });
    </script>
@endsection


