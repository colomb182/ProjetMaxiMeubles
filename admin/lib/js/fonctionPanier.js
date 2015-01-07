$(document).ready(function($) {
    //alert('refresh');
    $('.addPanier').click(function(event){
        event.preventDefault();
         $.get($(this).attr('href'),{},function(data){
              if (data.error){
                 alert('erreur');
             }else{
                 alert('Le meuble a été bien ajouté à votre panier');;
             }   
        });
        return false;
    });   
});


