
<div>
    <button id="btn-delete-modele" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex 				align-items-center justify-content-center">
        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
    </button>
    <div class="col-sm-6 mr-2">
        <label for="modeles" class="form-label fw-semibold text-primary-light text-sm m-8">Modèle ${x} </label>
        <select class="form-control radius-8 form-select" id="modele-select-${x}" required name="modeles[]">
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
        <label for="quantite" class="form-label fw-semibold text-primary-light text-sm m-8">Quantité ${x} </label>
        <input type="number" step="0.01" class="form-control radius-8" id="quantite-${x}"  name="quantite[]" >
    </div>
    <div class="col-sm-6 mr-2">
        <label for="remise" class="form-label fw-semibold text-primary-light text-sm m-8">Remise ${x} </label>
        <input type="number" step="0.01" class="form-control radius-8" id="remise-${x}"  name="remise[]" >
    </div>
    <div class="col-sm-6 mr-2">
        <label for="prix" class="form-label fw-semibold text-primary-light text-sm m-8">Prix ${x} </label>
        <input type="number" step="0.01" id="prix-${x}" class="form-control radius-8"  name="prix[]" >
    </div>
</div>
