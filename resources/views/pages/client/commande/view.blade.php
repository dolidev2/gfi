@extends('layouts.app')

@section('heads')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Voir une commande</h6>
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
                <li class="fw-medium">Voir une commande</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">   {{$client->nom_complet.'  '.$client->matricule.'  '.$client->contact}}</h6>
                                <form action="{{ route('client.commande.storeComposition') }}" method="POST">
                                    @csrf
                                    <div class="row mb-20">
                                        <div class="col-sm-6 mb-20 ">
                                            <legend>Informations sur la commande</legend>
                                        </div>
                                        <div class="col-sm-6 mb-20 ">
                                            <button type="button" class="btn btn-outline-primary border border-primary-600 text-md px-56 py-12 radius-8" id="btn-add-commande">
                                                Ajouter la composition de la commande
                                            </button>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Date de création <span class="text-danger-600">*</span></label>
                                                <input type="text" readonly class="form-control radius-8"  value="{{ date('d/m/Y', strtotime($commande->created_at))}}">
                                                <input type="hidden" name="commande_id" value="{{$commande->id}}">
                                                <input type="hidden" id="client_id"  name="client_id" value="{{$client->id}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Numéro de commande <span class="text-danger-600">*</span></label>
                                                <input type="text" readonly class="form-control radius-8"  value="{{ $commande->numero_commande }}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                            <div class="mb-20">
                                                <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Date de RDV <span class="text-danger-600">*</span></label>
                                                <input type="text" readonly class="form-control radius-8"  value="{{ date('d/m/Y', strtotime($commande->rgsbtdate_rdv))}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Statut <span class="text-danger-600">*</span></label>
                                                @if($commande->statut == env('STATUS_SUCCESS'))
                                                    <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Terminé</span>
                                                @elseif($commande->statut == env('STATUS_FAILED'))
                                                    <span class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">En cours</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-10">
                                            <fieldset id="titre-commande">
                                                <legend>Composition de la commande</legend>
                                                    @if(isset($commandeCompositions) && count($commandeCompositions) > 0 )
                                                        @foreach ($commandeCompositions as $key => $commandeComposition)
                                                           @php( $key ++)
                                                            <div class="row" id="commande-composition-view">
                                                                <div class="col-sm-6 mr-2">
                                                                    <button id="btn-delete-commandes" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                                    </button>
                                                                    <input type="hidden" id="id_composition" name="composition_id[]" value="{{ $commandeComposition->id }}">
                                                                    <label for="modeles" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle {{ $key }}<span class="text-danger-600">*</span></label>
                                                                    <select class="form-control radius-8 form-select" id="modeles-select-{{ $key }}" required name="modeles[]" required>
                                                                        @foreach ($modeles as $modele)
                                                                            @if($modele->id == $commandeComposition->modele_id)
                                                                                <option value="{{ $modele->id }}" selected>{{ $modele->nom }}</option>
                                                                            @else
                                                                                <option value="{{ $modele->id }}">{{ $modele->nom }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 mr-2">
                                                                    <label for="tissus" class="form-label fw-semibold text-primary-light text-sm m-8">Tissu {{ $key  }} </label>
                                                                    <select class="form-control radius-8 form-select" id="tissu-select-${x}" name="tissus[]">
                                                                        @if(isset($tissus) && count($tissus) > 0 )
                                                                            @foreach ($tissus as $tissu)
                                                                                @if($tissu->id == $commandeComposition->tissu_id)
                                                                                    <option value="{{ $tissu->id }}" selected>{{ $tissu->nom }}</option>
                                                                                @else
                                                                                    <option value="{{ $tissu->id }}">{{ $tissu->nom }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 mr-2">
                                                                    <label for="quantite" class="form-label fw-semibold text-primary-light text-sm m-8">Quantité {{ $key  }}  <span class="text-danger-600">*</span></label>
                                                                    @if(isset($commandeComposition->quantite) && $commandeComposition->quantite != null)
                                                                        <input type="number" step="0.01" class="form-control radius-8" id="quantite"  value="{{ $commandeComposition->quantite }}" name="quantite[]" >
                                                                    @else
                                                                        <input type="number" step="0.01" class="form-control radius-8" id="quantite"  value="0" name="quantite[]" >
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-6 mr-2">
                                                                    <label for="remise" class="form-label fw-semibold text-primary-light text-sm m-8">Remise {{ $key  }} </label>
                                                                    @if(isset($commandeComposition->remise) && $commandeComposition->remise != null)
                                                                        <input type="number" step="0.01" class="form-control radius-8" id="remise"  value="{{ $commandeComposition->remise }}" name="remise[]" >
                                                                    @else
                                                                        <input type="number" step="0.01" class="form-control radius-8" id="remise" value="0" name="remise[]" >
                                                                    @endif
                                                                    <input type="hidden" id="modelesCount" value="{{ count($commandeCompositions) }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div id="commande-composition" class="row">
                                                    </div>
                                            </fieldset>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center gap-3 mt-10">
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
                                    </div>
                                </form>
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

            var client_id = document.getElementById("client_id").value;
            if(typeof $('#modelesCount').val() == 'undefined'){
                var x = 0;
            }else{
                var x = $('#modelesCount').val() ;
                for(var i = 1; i <= x; i++){
                    $('#modeles-select-'+i).select2({
                        width: "100%",
                        height: "100%",
                        language: "fr",
                        placeholder : 'Choisir un modèle'
                    });
                }
            }
            var max_fields = 100;
            var wrapper = $('#commande-composition');
            var wrapperView = $('#commande-composition-view');
            var add_button = $('#btn-add-commande');

            $(add_button).click(function(e){
                e.preventDefault();
                $('#titre-commande').show();
                if(x < max_fields){
                    x++;
                    $(wrapper).append(
                        `
                            <div class="row">
                                <div class="col-sm-6 mr-2">
                                 <button id="btn-delete-commande" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex 				align-items-center justify-content-center">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </button>
                                    <label for="modeles" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle ${x} <span class="text-danger-600">*</span></label>
                                    <select class="form-control radius-8 form-select" id="modele-select-${x}" required name="modeles[]" required>
                                        <option>-------------------------------------------------</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mr-2">
                                    <label for="tissus" class="form-label fw-semibold text-primary-light text-sm m-8">Tissu ${x} </label>
                                    <select class="form-control radius-8 form-select" id="tissu-select-${x}" required name="tissus[]">
                                        <option>-------------------------------------------------</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mr-2">
                                    <label for="quantite" class="form-label fw-semibold text-primary-light text-sm m-8">Quantité ${x}  <span class="text-danger-600">*</span></label>
                                    <input type="number" step="0.01" class="form-control radius-8" id="quantite"  name="quantite[]" required>
                                </div>
                                <div class="col-sm-6 mr-2">
                                    <label for="remise" class="form-label fw-semibold text-primary-light text-sm m-8">Remise ${x} </label>
                                    <input type="number" step="0.01" class="form-control radius-8" id="remise"  name="remise[]" >
                                </div>
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
                                <option value="${obj.id}">${obj.nom+' - '+obj.description+' - '+obj.prix}</option>
                                `);
                            });
                        }
                    });
                fetch('/client/tissus/'+client_id)
                    .then( response => response.json() )
                    .then( response => {
                        if(response == 0){
                            response.forEach(obj =>{
                                $('#tissu-select-'+x).append(`
                                    <option value="${obj.id}">${obj.nom+' - '+obj.description}</option>
                                `);
                            });
                        }
                        else{
                            $('#tissu-select-'+x).append(`
                                <option value="0">Aucun tissu</option>
                            `);
                        }
                    });
                $('#modele-select-'+x).select2({
                    width: "100%",
                    height: "100%",
                    language: "fr",
                    placeholder : 'Choisir un modèle'
                });
                $('#tissu-select-'+x).select2({
                    width: "100%",
                    height: "100%",
                    language: "fr",
                    placeholder : 'Choisir un tissu'
                });
            });

            $(wrapper).on("click","#btn-delete-commande", function(e){
                e.preventDefault();
                removeRow($(this).parent().parent('div'));
                x--;
            });
            var btn_delete_composition = document.querySelectorAll('#btn-delete-commandes');
            btn_delete_composition.forEach(event => {
                event.addEventListener('click', function () {
                    var id_composition = event.children[1].value;
                    Swal.fire({
                        title: "Voulez vous vraiment supprimez ?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Supprimer",
                        denyButtonText: "Annuler",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            fetch('/client/commande/composition/delete/'+id_composition)
                                .then(response => response.json())
                                .then(response => {
                                    if (response == 0) {
                                        Swal.fire({
                                            title: 'Bravo',
                                            text: 'L\'article a été supprimé avec succès',
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
                            }, 2000); //2s
                            // refresh page
                        }
                    });
                });
            });

            function removeRow(row) {
                $(row).remove();
            }
        });
    </script>
@endsection


