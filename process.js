$(function () {
   
   // affichage data table : utilisant datatable
    $('table').DataTable();


    //Créer une facture (ajout):
        $('#create').on('click'   ,function (e) {
                let formOrder=$("#formOrder");
                if (formOrder[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url:'process.php',
                        type:'post',
                        data:formOrder.serialize()+'&action=create',
                        success:function (response) {
                            // disparaitre modal
                        $("#createmodal").modal("hide"); 
                        // afficher message sweet alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Enregistrement OK',
                        })
                        //initialiser le formulaire 
                        formOrder[0].reset();
                        getBills();
                        }
                    })
                }
        })

  

   //récuperation des facture pour affichage au chargement 
        getBills();
    function getBills() {
        $.ajax({
            url:'process.php',
            type:'post',
            data: {action:'fetch'},
            success:function (response) {
               $("#orderTable").html(response);
               $('table').DataTable();   
            }
        })
    }

   //récuperation d'une facture pour modif :
    $('body').on('click'  , '.editBtn' ,function (e) {
        e.preventDefault();
        $.ajax({
            url:'process.php',
            type:'post',
            data:{id_update:this.dataset.id},
            success:function (response) {
                //let dnn=JSON.parse(response);
               let facture=JSON.parse(response);               
               $("#updatcustomer").val(facture.customer);
               $("#updatamount").val(facture.amount);
               $("#updatcashier").val(facture.cashier);
               $("#updatreceived").val(facture.received);
               $("#id_facture").val(facture.id);
              
               //traitement pour choisir l'etat de la facure prevenant de la base
               let etats=document.getElementById("updatetat")
               let seletions= Array.from(etats.options); //mettre les options dans un tableau
               seletions.forEach( (o,i)=>{
                  if(o.value===facture.etat) $("#updatetat").val(facture.etat);
               });


            }
        })
    })

   // modification de la facture choisi :
       $("#updat_btn").on("click",function(e) {
        let formupdate=$("#formupdate");
        if (formupdate[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url:'process.php',
                type:'post',
                data:formupdate.serialize()+'&action=updat',
                success:function (response) {
                    // disparaitre modal
                 $("#updatmodal").modal("hide"); 
                 
                // afficher message sweet alert
                Swal.fire({
                    icon: 'success',
                    title: 'Enregistrement modifié',
                })
                
                getBills();
                }
            })
        }
       });

    $("body").on('click','.infoBtn',function(e){
        e.preventDefault();

        $.ajax({
            url:'process.php',
            type:'post',
            data:{id_info:this.dataset.id},
            success:function(response){
                let info_facture=JSON.parse(response);
                let=info_affiche= "Customer : "+info_facture.customer+"<br>"+"caissier : "+info_facture.cashier+"<br>"+"etat : "+info_facture.etat+"<br>"+"Montant : "+info_facture.amount+"<br>"
                Swal.fire({
                    title: '<strong>'+info_facture.id + " : " + info_facture.customer+ '<u></u></strong>',
                    icon: 'info',
                    html:
                      '<a href="//sweetalert2.github.io">notre site</a><br> ' +
                      info_affiche+'',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                      '<i class="fa fa-thumbs-up"></i> Great!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText:
                      '<i class="fa fa-thumbs-down"></i>',
                    cancelButtonAriaLabel: 'Thumbs down'
                  })
            }

        })




    });

//button de supprission
$("body").on("click",".deleteBtn",function(e){
    e.preventDefault();
    //--------------------------
    Swal.fire({
        title: 'voulez vous supprimer la facture N° ? '+this.dataset.id,
        text: "Cette action est irreversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Supprimer!'

    }).then((result) => {
        if (result.isConfirmed) {
            //ajax

            $.ajax({
                url:'process.php',
                type:'post',
                data:{id_supp:this.dataset.id},
                success:function(response){
                        Swal.fire(
                            'Suprimé!',
                            'La facture est supprimé.',
                            'success'
                        )
            getBills();
                }   
            });
        
        }
})

    


    

});



})

