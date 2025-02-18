$(document).ready(function () {
    $('#btn-edit').click(function (){

        var user_input_check = document.querySelectorAll('#user-input-check');
        var data = [];

        // Verify if checkboxes are checked
        user_input_check.forEach(event => {
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

            window.location.href = "edit/"+data[0].value;
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
    });

    $('#btn-delete').click(function (){
        var user_input_check = document.querySelectorAll('#user-input-check');
        var data = [];

        // Verify if checkboxes are checked
        user_input_check.forEach(event => {
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
                        fetch('delete/'+item.value)
                            .then( response => response.json() )
                            .then( response => {
                                if(response == 0 ){
                                    Swal.fire({
                                        title: 'Bravo',
                                        text: 'L\'utilisateur a été supprimé avec succès',
                                        icon: 'success',
                                    });
                                } else if( response == 1){
                                    Swal.fire({
                                        title: 'Erreur',
                                        text: 'Vous n\'êtes pas autorisé à supprimer l\'offre',
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

    });
});



