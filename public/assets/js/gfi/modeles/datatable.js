
$('#modeleTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$('#modeleTable').DataTable( {
    responsive: true,
    destroy: true,
    order: [2, 'asc'],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',
        "paginate": {
            "previous": "<",
            "next": ">",
            "first": "",
            "last": ""
        }
    },
    layout: {
        autoResize: true,
        autoSize: true,
        height: 500,
        width: 1000,
        topStart: {
            buttons: [
                {
                    text: '<button id="btn-view-modeles" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var tissu_input_check = document.querySelectorAll('#modele-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        tissu_input_check.forEach(event => {
                            if(event.checked){
                                data.push(event);
                            }
                        });

                        if(data.length == 0){
                            Toastify({
                                text: "Aucune ligne sélectionnée",
                                className: "info",
                                duration:4000,
                                close: true,
                                style: {
                                    background: "linear-gradient(to right, blue, purple)",
                                }
                            }).showToast();
                        }

                        if( data.length == 1){

                            window.location.href =  "detail/"+data[0].value;
                        }

                        if( data.length >= 2){

                            Toastify({
                                text: "Sélectionnez une seule ligne",
                                className: "error",
                                duration:4000,
                                close: true,
                                style: {
                                    background: "linear-gradient(to right, red, orange)",
                                }
                            }).showToast();
                        }

                    }

                },
                {
                    text: ' <button id="btn-edit-mesure" type="button" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:edit"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var tissu_input_check = document.querySelectorAll('#modele-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        tissu_input_check.forEach(event => {
                            if(event.checked){
                                data.push(event);
                            }
                        });

                        if(data.length == 0){
                            Toastify({
                                text: "Aucune ligne sélectionnée",
                                className: "info",
                                duration:4000,
                                close: true,
                                style: {
                                    background: "linear-gradient(to right, blue, purple)",
                                }
                            }).showToast();
                        }

                        if( data.length == 1){

                            window.location.href =  "edit/"+data[0].value;
                        }

                        if( data.length >= 2){

                            Toastify({
                                text: "Sélectionnez une seule ligne",
                                className: "error",
                                duration:4000,
                                close: true,
                                style: {
                                    background: "linear-gradient(to right, red, orange)",
                                }
                            }).showToast();
                        }
                    }

                },
                {
                    text: '   <button id="btn-delete-mesure" type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>\n' +
                        '                    </button>',
                },
                {
                    text: '   <button id="btn-print-mesure" type="button" class="w-32-px h-32-px bg-info-focus info rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:printer-check"></iconify-icon>\n' +
                        '                    </button>',
                },
                {
                    text: '   <button id="btn-add-mesure" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">\n' +
                        '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                        '                    Ajouter un modèle\n' +
                        '                </button>',
                    action: function ( e, dt, node, config ) {
                        window.location.href = "add";
                    }
                }
            ]
        },
    }
} );
