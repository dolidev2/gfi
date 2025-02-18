@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Afficher l'historique des mesures</h6>
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
                <li class="fw-medium">Afficher l'historique des mesures</li>
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
                                                <label for="sexe" class="form-label fw-semibold text-primary-light text-sm mb-8">Date de dernière modification </label>
                                                <input type="text" readonly class="form-control radius-8" value=" {{ date('d/m/Y H:i:s', strtotime($mesure->updated_at))}}">
                                            </div>
                                            <div class="mb-20">
                                                <label for="sexe" class="form-label fw-semibold text-primary-light text-sm mb-8">Sexe <span class="text-danger-600">*</span></label>
                                                <select class="form-control radius-8 form-select" id="sexe" readonly >
                                                    <option value="{{ env('SEXE_MASCULIN') }}" {{ $mesure->sexe == env('SEXE_MASCULIN') ? 'selected' : '' }}>{{ env('SEXE_MASCULIN') }}</option>
                                                    <option value="{{ env('SEXE_FEMININ') }}" {{ $mesure->sexe== env('SEXE_FEMININ') ? 'selected' : '' }}>{{ env('SEXE_FEMININ') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="epaule" class="form-label fw-semibold text-primary-light text-sm mb-8">Epaule</label>
                                                <input type="text"  readonly class="form-control radius-8" value="{{ $mesure->epaule }}"  >
                                                 <table>
                                                     <tr>
                                                         @foreach ($mesure_historiques as $mesure_historique)
                                                             @if($mesure_historique->epaule != $mesure->epaule)
                                                                 @if($mesure_historique->epaule != null)
                                                                     <td>
                                                                         <span>
                                                                               {{ $mesure_historique->epaule.'-' }}
                                                                         </span>
                                                                     </td>
                                                              @endif
                                                             @endif
                                                         @endforeach
                                                     </tr>
                                                 </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="largeur_epaule" class="form-label fw-semibold text-primary-light text-sm mb-8">Largeur Epaule </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->largeur_epaule}}" name="largeur_epaule" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->largeur_epaule != $mesure->largeur_epaule)
                                                                @if($mesure_historique->largeur_epaule != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->largeur_epaule.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="carrure" class="form-label fw-semibold text-primary-light text-sm mb-8">Carrure </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->carrure}}" name="carrure" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->carrure != $mesure->carrure)
                                                                @if($mesure_historique->carrure != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->carrure.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Poitrine</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->poitrine}}" name="poitrine" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->poitrine != $mesure->poitrine)
                                                                @if($mesure_historique->poitrine != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->poitrine.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="dos" class="form-label fw-semibold text-primary-light text-sm mb-8">Dos</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->dos}}" name="dos" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->dos != $mesure->dos)
                                                                @if($mesure_historique->dos != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->dos.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_taille" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour de Taille</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->tour_taille}}" name="tour_taille" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->tour_taille != $mesure->tour_taille)
                                                                @if($mesure_historique->tour_taille != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->tour_taille.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="ceinture" class="form-label fw-semibold text-primary-light text-sm mb-8">Ceinture </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->ceinture}}" name="ceinture" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->ceinture != $mesure->ceinture)
                                                                @if($mesure_historique->ceinture != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->ceinture.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="bassin" class="form-label fw-semibold text-primary-light text-sm mb-8">Bassin</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->bassin }}" name="bassin" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->bassin != $mesure->bassin)
                                                                @if($mesure_historique->bassin != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->bassin.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="cuisse" class="form-label fw-semibold text-primary-light text-sm mb-8">Cuisse</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->cuisse}}" name="cuisse" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->cuisse != $mesure->cuisse)
                                                                @if($mesure_historique->cuisse != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->cuisse.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_genou" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour des genoux </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->tour_genou}}" name="tour_genou" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->tour_genou != $mesure->tour_genou)
                                                                @if($mesure_historique->tour_genou != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->tour_genou.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="bas" class="form-label fw-semibold text-primary-light text-sm mb-8">Bas </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{$mesure->bas}}" name="bas" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->bas != $mesure->bas)
                                                                @if($mesure_historique->bas != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->bas.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="cole" class="form-label fw-semibold text-primary-light text-sm mb-8">Cole </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->cole}}" name="cole" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->cole != $mesure->cole)
                                                                @if($mesure_historique->cole != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->cole.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="tour_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Tour de manche</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->tour_manche}}" name="tour_manche" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->tour_manche != $mesure->tour_manche)
                                                                @if($mesure_historique->tour_manche != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->tour_manche.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur manche</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_manche}}" name="longueur_manche" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_manche != $mesure->longueur_manche)
                                                                @if($mesure_historique->longueur_manche != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_manche.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_taille" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur de taille </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_taille}}" name="longueur_taille" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_taille != $mesure->longueur_taille)
                                                                @if($mesure_historique->longueur_taille != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_taille.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_chemise" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur chemise</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_chemise}}" name="longueur_chemise" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_chemise != $mesure->longueur_chemise)
                                                                @if($mesure_historique->longueur_chemise != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_chemise.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_tunique" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur tunique</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_tunique}}" name="longueur_tunique" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_tunique != $mesure->longueur_tunique)
                                                                @if($mesure_historique->longueur_tunique != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_tunique.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_gilet" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur gilet </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_gilet}}" name="longueur_gilet" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_gilet != $mesure->longueur_gilet)
                                                                @if($mesure_historique->longueur_gilet != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_gilet.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_veste" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur veste</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_veste}}" name="longueur_veste" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_veste != $mesure->longueur_veste)
                                                                @if($mesure_historique->longueur_veste != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_veste.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_genou" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur genoux</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->tour_manche}}" name="tour_manche" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->tour_manche != $mesure->tour_manche)
                                                                @if($mesure_historique->tour_manche != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->tour_manche.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_manche" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur manche</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_genou}}" name="longueur_genou" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_genou != $mesure->longueur_genou)
                                                                @if($mesure_historique->longueur_genou != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_genou.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_pantalon" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur pantalon </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_pantalon}}" name="longueur_pantalon" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_pantalon != $mesure->longueur_pantalon)
                                                                @if($mesure_historique->longueur_pantalon != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_pantalon.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="longueur_pantacourt" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur pantacourt</label>
                                                <input type="text"  readonly class="form-control radius-8" value="{{ $mesure->longueur_pantacourt}}" name="longueur_pantacourt" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_pantacourt != $mesure->longueur_pantacourt)
                                                                @if($mesure_historique->longueur_pantacourt != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_pantacourt.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="entre_jambe" class="form-label fw-semibold text-primary-light text-sm mb-8">Entre jambe</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->entre_jambe}}" name="entre_jambe" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->entre_jambe != $mesure->entre_jambe)
                                                                @if($mesure_historique->entre_jambe != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->entre_jambe.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="frappe" class="form-label fw-semibold text-primary-light text-sm mb-8">Frappe</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->frappe}}" name="frappe" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->frappe != $mesure->frappe)
                                                                @if($mesure_historique->frappe != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->frappe.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-20">
                                                <label for="chapeau" class="form-label fw-semibold text-primary-light text-sm mb-8">Chapeau </label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->chapeau}}" name="chapeau" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->chapeau != $mesure->chapeau)
                                                                @if($mesure_historique->chapeau != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->chapeau.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="sexe_feminin1">
                                            <div class="mb-20">
                                                <label for="longueur_jupe" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur jupe</label>
                                                <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_jupe}}" name="longueur_jupe" >
                                                <table>
                                                    <tr>
                                                        @foreach ($mesure_historiques as $mesure_historique)
                                                            @if($mesure_historique->longueur_jupe != $mesure->longueur_jupe)
                                                                @if($mesure_historique->longueur_jupe != null)
                                                                    <td>
                                                                         <span>
                                                                               {{ $mesure_historique->longueur_jupe.'-' }}
                                                                         </span>
                                                                    </td>
                                                              @endif
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="sexe_feminin" class="row">
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="ecart_pince_poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Ecart pince poitrine</label>
                                                    <input type="text" readonly class="form-control radius-8" value="{{ $mesure->ecart_pince_poitrine}}" name="ecart_pince_poitrine" >
                                                    <table>
                                                        <tr>
                                                            @foreach ($mesure_historiques as $mesure_historique)
                                                                @if($mesure_historique->ecart_pince_poitrine != $mesure->ecart_pince_poitrine)
                                                                    @if($mesure_historique->ecart_pince_poitrine != null)
                                                                        <td>
                                                                             <span>
                                                                                   {{ $mesure_historique->ecart_pince_poitrine.'-' }}
                                                                             </span>
                                                                        </td>
                                                                      @endif
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="longueur_haut" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur haut</label>
                                                    <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_haut}}" name="longueur_haut" >
                                                    <table>
                                                        <tr>
                                                            @foreach ($mesure_historiques as $mesure_historique)
                                                                @if($mesure_historique->longueur_haut != $mesure->longueur_haut)
                                                                    @if($mesure_historique->longueur_haut != null)
                                                                        <td>
                                                                             <span>
                                                                                   {{ $mesure_historique->longueur_haut.'-' }}
                                                                             </span>
                                                                        </td>
                                                                      @endif
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="longueur_robe" class="form-label fw-semibold text-primary-light text-sm mb-8">Longueur Robe</label>
                                                    <input type="text" readonly class="form-control radius-8" value="{{ $mesure->longueur_robe}}" name="longueur_robe" >
                                                    <table>
                                                        <tr>
                                                            @foreach ($mesure_historiques as $mesure_historique)
                                                                @if($mesure_historique->longueur_robe != $mesure->longueur_robe)
                                                                    @if($mesure_historique->longueur_robe != null)
                                                                        <td>
                                                                             <span>
                                                                                   {{ $mesure_historique->longueur_robe.'-' }}
                                                                             </span>
                                                                        </td>
                                                                      @endif
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-20">
                                                    <label for="hauteur_poitrine" class="form-label fw-semibold text-primary-light text-sm mb-8">Hauteur Poitrine </label>
                                                    <input type="text" readonly class="form-control radius-8" value="{{ $mesure->hauteur_poitrine}}" name="hauteur_poitrine" >
                                                    <table>
                                                        <tr>
                                                            @foreach ($mesure_historiques as $mesure_historique)
                                                                @if($mesure_historique->hauteur_poitrine != $mesure->hauteur_poitrine)
                                                                    @if($mesure_historique->hauteur_poitrine != null)
                                                                        <td>
                                                                             <span>
                                                                                   {{ $mesure_historique->hauteur_poitrine.'-' }}
                                                                             </span>
                                                                        </td>
                                                                      @endif
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
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


