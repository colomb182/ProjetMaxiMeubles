$(document).ready(function() {
    //alert('refresh');
    $('input#envoi_choix').hide();
  $('select#choix').change(function() {
        var selection=$(this).attr('name');
        var valeur_selection = $(this).val();
        //ici on affiche l'id dans la BD
        //alert(valeur_selection);
        var refresh = 'index.php?page=catmeubles&amp;'+selection+'='+valeur_selection +'&envoi_choix=Go';
        //alert(refresh);
        window.location.href=refresh;
    });
    
});

