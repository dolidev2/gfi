$('#commandeReportRDVTable tr').click(function (event) {
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
getDatePicker('#date_report');
getDatePicker('#date_report_up');
var client_id = document.getElementById("client_id").value;

$('#commandeReportRDVTable').DataTable( {
    responsive: true,
    pageLength: 5,
    destroy: true,
    order: [0, 'desc'],
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
                    text: ' <button id="btn-edit-report" type="button" class="w-50-px h-50-px  bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:edit"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var report_input_check = document.querySelectorAll('#report-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        report_input_check.forEach(event => {
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
                            fetch('/client/commande/report/viewOne/'+data[0].value)
                                .then( response => response.json() )
                                .then( response => {
                                    if(response != 1){
                                        const date = new Date(response.date_rdv);
                                        $('#date_report_up').val(date.toLocaleDateString());
                                        $('#report_motif_up').val(response.motif);
                                        $('#commande_id_report_up').val(response.id);
                                    }
                                });
                            $('#updateReportRDVModal').modal('show');
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
                    text: '   <button id="btn-delete-report" type="button" class="w-50-px h-50-px  bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var report_input_check = document.querySelectorAll('#report-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        report_input_check.forEach(event => {
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
                        if( data.length  != 0){
                            Swal.fire({
                                title: "Voulez vous vraiment supprimez ?",
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: "Supprimer",
                                denyButtonText: "Annuler",
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    data.forEach(item =>{
                                        fetch('/client/commande/report/delete/'+item.value)
                                            .then( response => response.json() )
                                            .then( response => {
                                                if(response == 0 ){
                                                    Swal.fire({
                                                        title: 'Bravo',
                                                        text: 'Report(s) supprimé(s) avec succès',
                                                        icon: 'success',
                                                    });
                                                } else if( response == 1){
                                                    Swal.fire({
                                                        title: 'Erreur',
                                                        text: 'Vous n\'êtes pas autorisé à supprimer',
                                                        icon: 'error',
                                                    });
                                                }
                                            });
                                    });
                                    setTimeout(function () {
                                        location.reload();
                                    }, 3000); //3s
                                    // refresh page
                                }
                            });
                        }



                    }
                },
                {
                    text: '   <button id="btn-print-report" type="button" class="w-50-px h-50-px  bg-info-focus info rounded-circle d-inline-flex align-items-center justify-content-center">\n' +
                        '                        <iconify-icon icon="lucide:printer-check"></iconify-icon>\n' +
                        '                    </button>',
                    action: function ( e, value, row, index ) {
                        var report_input_check = document.querySelectorAll('#report-input-check');
                        var data = [];

                        // Verify if checkboxes are checked
                        report_input_check.forEach(event => {
                            if(event.checked){
                                data.push(event);
                            }
                        });

                        if(data.length == 0 || data.length > 1){

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
                        if( data.length == 1){
                            let a= document.createElement('a');
                            a.target= '_blank';
                            a.href= "/client/"+client_id+"/commande/report/print/"+data[0].value;
                            a.click();
                        }
                    }
                },
                {
                    text: '   <button id="btn-add-report-rdv" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" >\n' +
                        '                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>\n' +
                        '                    Ajouter un report RDV\n' +
                        '                </button>',
                    action: function ( e, dt, node, config ) {
                        $('#addReportRDVModal').modal('show');
                    }
                }
            ]
        },
    }
} );
