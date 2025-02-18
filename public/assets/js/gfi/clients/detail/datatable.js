
$('#clientCommandeTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});
$('#commandePaiementTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});
// Flat pickr or date picker js
function getDatePicker (receiveID) {
    flatpickr(receiveID, {
        enableTime: true,
        dateFormat: "d/m/Y",
    });
}
getDatePicker('#date_rdv');
getDatePicker('#date_created');
getDatePicker('#date_report');

var client_id= document.getElementById("client_id_cmd").value;

$('#clientCommandeTable').DataTable( {
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
                    text: '<button id="btn-view-commande" class="w-50-px h-50-px  bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="iconamoon:eye-light" class="text-xl"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');
                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
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
                            window.location.href =  "/client/"+client_id+"/commande/view/"+data[0].value;
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
                    text: ' <button id="btn-edit-commande" type="button" class="w-50-px h-50-px  bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" >\n' +
                        '                        <iconify-icon icon="lucide:edit" class="text-xl"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');
                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
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
                            fetch('/client/commande/view/'+data[0].value)
                                .then( response => response.json() )
                                .then( response => {
                                    if(response != 1 ){

                                        $('#date_created_up').val(response.date_created);
                                        $('#numero_commande_up').val(response.numero_commande);
                                        $('#commande_id_up').val(response.id);
                                        if(response.statut == '0'){
                                            $('#statut_up').append(`
                                                <option value="{{ env('STATUS_FAILED') }}" >En cours</option>
                                                <option value="{{ env('STATUS_SUCCESS') }}" selected>Terminé</option>
                                            `)
                                        }
                                        else{
                                            $('#statut_up').append(`
                                                <option value="{{ env('STATUS_FAILED') }}" selected>En cours</option>
                                                <option value="{{ env('STATUS_SUCCESS') }}">Terminé</option>
                                            `)
                                        }
                                        $('#updateCommandeModal').modal('show');
                                    }
                                });
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
                    text: ' <button id="btn-paiement-commande" type="button" class="w-50-px h-50-px  bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="tdesign:money" class="text-xl"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');
                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
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
                            window.location.href =  "/client/"+client_id+"/commande/paiement/view/"+data[0].value;
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
                    text: '<button id="btn-view-print" class="w-50-px h-50-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="material-symbols:print-outline" class="text-xl"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {

                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');

                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
                            if(event.checked){
                                data.push(event);
                            }
                        });

                        if(data.length == 0 || data.length > 1){
                            let a= document.createElement('a');
                            a.target= '_blank';
                            a.href= "/client/"+client_id+"/commande/printAll/";
                            a.click();
                        }
                        if( data.length == 1){
                            let a= document.createElement('a');
                            a.target= '_blank';
                            a.href= "/client/"+client_id+"/commande/print/"+data[0].value;
                            a.click();
                        }
                    }

                },
                {
                    text: '   <button id="btn-rdv-commande" type="button" class="w-50-px h-50-px  bg-success-focus  text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" >\n' +
                '                    <iconify-icon icon="pepicons-print:loop-circle" class="text-xl"></iconify-icon>\n' +
        '                       </button>',
                    action: function ( e, value, row, index ) {
                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');
                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
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
                            window.location.href =  "/client/commande/report/view/"+data[0].value;
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
                    text: '   <button id="btn-delete-commande" type="button" class="w-50-px h-50-px  bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line" class="text-xl"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {

                        var commande_input_check = document.querySelectorAll('#client-commande-input-check');
                        var data = [];
                        // Verify if checkboxes are checked
                        commande_input_check.forEach(event => {
                            if(event.checked){
                                data.push(event);
                            }
                        });
                        if(data.length == 0 || data.length > 1){
                            Toastify({
                                text: "Sélectionnez une seule ligne",
                                className: "info",
                                duration:4000,
                                close: true,
                                style: {
                                    background: "linear-gradient(to right, blue, purple)",
                                }
                            }).showToast();
                        }
                        if( data.length == 1){
                            Swal.fire({
                                title: "Voulez vous vraiment supprimer ?",
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: "Supprimer",
                                denyButtonText: "Annuler",
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    fetch('/client/commande/delete/'+data[0].value)
                                        .then( response => response.json() )
                                        .then( response => {
                                            if(response == 0 ){
                                                Swal.fire({
                                                    title: 'Bravo',
                                                    text: 'Commande(s) supprimée(s) avec succès',
                                                    icon: 'success',
                                                });
                                            } else if( response == 1){
                                                Swal.fire({
                                                    title: 'Erreur',
                                                    text: 'Il n\'y a pas de mesure à supprimer',
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
                        }


                    }
                },

                {
                    text: '   <a href="{{ route(\'clients.add\') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addCommandeModal">\n' +
                        '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                        '                    Ajouter une commande\n' +
                        '                </a>',
                }
            ]
        },
    }
} );

$('#clientMesureTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$('#clientTissuTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

var client_id = document.getElementById("client_id").value;
var mesure_id = document.getElementById("mesure_id").value;

$('#clientMesureTable').DataTable( {
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
                    text: '<button id="btn-view-mesure" class="w-50-px h-50-px  bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        if(mesure_id != 0){
                            window.location.href =  "/client/"+client_id+"/mesure/view/"+mesure_id;
                        }
                    }

                },
                {
                    text: ' <button id="btn-edit-mesure" type="button" class="w-50-px h-50-px  bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:edit"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        if(mesure_id != 0){
                            window.location.href = "/client/"+client_id+"/mesure/edit/"+mesure_id;
                        }
                    }

                },
                {
                    text: '   <button id="btn-print-mesure" type="button" class="w-50-px h-50-px  bg-info-focus info rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:printer-check"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        let a= document.createElement('a');
                        a.target= '_blank';
                        a.href= "/client/mesure/print/"+client_id;
                        a.click();
                    }
                },
                {
                    text: '   <button id="btn-delete-mesure" type="button" class="w-50-px h-50-px  bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {

                        Swal.fire({
                            title: "Voulez vous vraiment supprimer ?",
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: "Supprimer",
                            denyButtonText: "Annuler",
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            console.log(client_id)
                            if (result.isConfirmed) {
                                fetch('/client/mesure/delete/'+client_id)
                                    .then( response => response.json() )
                                    .then( response => {
                                        if(response == 0 ){
                                            Swal.fire({
                                                title: 'Bravo',
                                                text: 'Mesure supprimé avec succès',
                                                icon: 'success',
                                            });
                                        } else if( response == 1){
                                            Swal.fire({
                                                title: 'Erreur',
                                                text: 'Il n\'y a pas de mesure à supprimer',
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
                    }
                },


                {
                    text: '   <button id="btn-add-mesure" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">\n' +
                    '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                    '                    Ajouter une mesure\n' +
                    '                </button>',
                        action: function ( e, dt, node, config ) {
                            if(mesure_id == 0){
                                window.location.href = "/client/mesure/add/"+client_id;
                            }
                            else{
                                Toastify({
                                    text: "La mesure du client existe déjà !",
                                    className: "info",
                                    duration:4000,
                                    close: true,
                                    style: {
                                        background: "linear-gradient(to right, blue, purple)",
                                    }
                                }).showToast();
                            }
                    }
                }
            ]
        },
    }
} );

$('#clientTissuTable').DataTable( {
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
                    text: '<button id="btn-view-tissu" class="w-50-px h-50-px  bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var tissu_input_check = document.querySelectorAll('#client-tissu-input-check');
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

                            window.location.href =  "/client/"+client_id+"/tissu/view/"+data[0].value;
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
                    text: ' <button id="btn-edit-tissu" type="button" class="w-50-px h-50-px  bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:edit"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var tissu_input_check = document.querySelectorAll('#client-tissu-input-check');
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

                            window.location.href =  "/client/"+client_id+"/tissu/edit/"+data[0].value;
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
                // {
                //     text: '   <button id="btn-print-tissu" type="button" class="w-50-px h-50-px  bg-info-focus info rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                //         '                        <iconify-icon icon="lucide:printer-check"></iconify-icon>\n' +
                //         '                    </button>',
                // },
                {
                    text: '   <button id="btn-delete-tissu" type="button" class="w-50-px h-50-px  bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>\n' +
                        '                    </button>',
                action: function ( e, value, row, index ) {
                        var tissu_input_check = document.querySelectorAll('#client-tissu-input-check');
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

                        if( data.length >= 1){
                                Swal.fire({
                                    title: "Voulez vous vraiment supprimer ?",
                                    showDenyButton: true,
                                    showCancelButton: false,
                                    confirmButtonText: "Supprimer",
                                    denyButtonText: "Annuler",
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        data.forEach(item =>{
                                            fetch('/client/tissu/delete/'+item.value)
                                                .then( response => response.json() )
                                                .then( response => {
                                                    if(response == 0 ){
                                                        Swal.fire({
                                                            title: 'Bravo',
                                                            text: 'Tissu supprimé avec succès',
                                                            icon: 'success',
                                                        });
                                                    } else if( response == 1){
                                                        Swal.fire({
                                                            title: 'Erreur',
                                                            text: 'Il n\'y a pas de tissu à supprimer',
                                                            icon: 'error',
                                                        });
                                                    }
                                                });
                                        });
                                    }
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000); //2s
                                // refresh page
                        }
                    }
                },

                {
                    text: '   <button id="btn-add-tissu" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" >\n' +
                        '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                        '                    Ajouter un tissu\n' +
                        '                </button>',
                    action: function ( e, dt, node, config ) {
                        window.location.href = "/client/tissu/add/"+client_id;
                    }
                }
            ]
        },
    }
} );

$('#clientRemarquesTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$('#clientRemarquesTable').DataTable( {
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
                    text: '<button id="btn-view-remarques" class="w-50-px h-50-px  bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var remarques_input_check = document.querySelectorAll('#client-remarques-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        remarques_input_check.forEach(event => {
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

                            window.location.href =  "/client/"+client_id+"/tissu/view/"+data[0].value;
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
                    text: ' <button id="btn-edit-remarques" type="button" class="w-50-px h-50-px  bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:edit"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var remarques_input_check = document.querySelectorAll('#client-remarques-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        remarques_input_check.forEach(event => {
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

                            fetch('/client/remarque/view/'+data[0].value)

                                .then( response => response.json() )
                                .then( response => {
                                    console.log(response);
                                    if(response != 1 ){
                                        $('#commande_select_remarque_up').append(`
                                                <option value="${response.commande.id}" selected>${response.commande.numero_commande}</option>
                                            `);
                                        $('#remarque_description_up').val(response.commentaire);
                                        $('#remarque_id_up').val(response.id);

                                        $('#updateRemarqueModal').modal('show');
                                    }
                                });

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
                    text: '   <button id="btn-print-remarques" type="button" class="w-50-px h-50-px  bg-info-focus info rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:printer-check"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {

                        var remarques_input_check = document.querySelectorAll('#client-remarques-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        remarques_input_check.forEach(event => {
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

                            let a= document.createElement('a');
                            a.target= '_blank';
                            a.href= "/client/remarque/print/"+data[0].value;
                            a.click();

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
                    text: '   <button id="btn-delete-remarques" type="button" class="w-50-px h-50-px  bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var remarques_input_check = document.querySelectorAll('#client-remarques-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        remarques_input_check.forEach(event => {
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

                        if( data.length >= 1){
                            Swal.fire({
                                title: "Voulez vous vraiment supprimer ?",
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: "Supprimer",
                                denyButtonText: "Annuler",
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    data.forEach(item =>{
                                        fetch('/client/remarque/delete/'+item.value)
                                            .then( response => response.json() )
                                            .then( response => {
                                                if(response == 0 ){
                                                    Swal.fire({
                                                        title: 'Bravo',
                                                        text: 'Remarque supprimé avec succès',
                                                        icon: 'success',
                                                    });
                                                } else if( response == 1){
                                                    Swal.fire({
                                                        title: 'Erreur',
                                                        text: 'Il n\'y a pas de remarque à supprimer',
                                                        icon: 'error',
                                                    });
                                                }
                                            });
                                    });
                                }
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 2000); //2s
                            // refresh page
                        }
                    }
                },

                {
                    text: '   <button id="btn-add-remarques" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" >\n' +
                        '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                        '                    Ajouter une Remarque\n' +
                        '                </button>',
                    action: function ( e, dt, node, config ) {
                      $('#addRemarqueModal').modal('show');
                    }
                }
            ]
        },
    }
} );





