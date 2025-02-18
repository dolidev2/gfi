@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Modifier un tissu</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('clients.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Client
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">
                    <a href="{{ route('clients.view',$client->id) }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        Tissu
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Modifier un tissu</li>
            </ul>
        </div>
        <div class="card h-100 p-0 radius-12">
            <div class="card-body p-24">
                <div class="row ">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">   {{$client->nom_complet.'  '.$client->matricule.'  '.$client->contact}}</h6>
                                <form action="{{ route('client.tissu.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-20">

                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="nom" class="form-label fw-semibold text-primary-light text-sm mb-8">Nom <span class="text-danger-600">*</span></label>
                                                <input type="text" class="form-control radius-8" @error('nom') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror value="{{ $tissu->nom}}" name="nom" >
                                                <input type="hidden" value="{{ $tissu->id }}" name="tissu_id" >    @error('nom')
                                                <span class="text-danger-600">{{ $message }}</span>
                                                @enderror
                                                <input type="hidden" class="form-control radius-8" value="{{ $client->id }}" name="client_id" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-20">
                                                <label for="description" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                                <input type="text" class="form-control radius-8" value="{{ $tissu->description}}" name="description" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mt-40">
                                                <input type="checkbox" class="form-check-input radius-8" id="acheter" onclick='handleClick(this);'>
                                                <label  class="form-label fw-semibold text-primary-light text-sm mb-8">Tissu acheté?, oui cochez </label>
                                            </div>
                                        </div>
                                        <div class="row" id="acheter-row">
                                            <div class="col-sm-4">
                                                <div class="mb-20">
                                                    <label for="quantite" class="form-label fw-semibold text-primary-light text-sm mb-8">Quantité </label>
                                                    <input type="number" step="0.01" class="form-control radius-8" value="{{ $tissu->quantite }}" id="quantite" name="quantite" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-20">
                                                    <label for="prix" class="form-label fw-semibold text-primary-light text-sm mb-8">Prix </label>
                                                    <input type="number" step="0.01" class="form-control radius-8" value="{{ $tissu->prix }}" id="prix" name="prix" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-20">
                                                    <label for="commission" class="form-label fw-semibold text-primary-light text-sm mb-8">Commission </label>
                                                    <input type="number" step="0.01" class="form-control radius-8" value="{{ $tissu->commission}}" id="commission" name="commission" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="upload-image-wrapper d-flex align-items-center gap-3 flex-wrap">
                                                <div class="uploaded-imgs-container d-flex gap-3 flex-wrap">
                                                    @if(isset($tissu->images) && count($tissu->images) >0)
                                                        @foreach ($tissu->images as $image)
                                                            <div class="position-relative h-120-px w-220-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                                <img src="{{ asset('images/tissus/'.$image->nom) }}" alt="" width="100%" height="100%" class="w-150 h-100 object-fit-cover">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <label class="upload-file-multiple h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1" for="upload-file-multiple">
                                                    <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                                                    <span class="fw-semibold text-secondary-light">Images</span>
                                                    <input id="upload-file-multiple" @error('imagesTissu') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror type="file" name="imagesTissu[]" hidden multiple>
                                                    @error('imagesTissu')
                                                    <span class="text-danger-main fw-semibold">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </label>
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
            $('#acheter-row').hide();
            var prix = document.getElementById("prix").value;
            if(prix > 0 ){
                $('#acheter-row').show();
            }
            $('#acheter').click(function(){
                if($('#acheter').is(':checked')){
                    $('#acheter-row').show();
                }
                else{
                    $('#acheter-row').hide();
                }
            })
        });

    </script>
@endsection


