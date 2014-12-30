<?php

if(isset($_GET['descr']))
{
   //print "essai 1";
   //print "<br/>".$_GET['descr'];
   $idModele=$_GET['descr'];
  
}

if(isset($idModele)){
    $mg = new ModeleManager($db);
    $meuble = $mg->getModele($idModele);
    ?>
<section id="fiche">
    
    
    <figure id="imageProd">
        
        
        <img src="../admin/images/<?php print $meuble[0]->photog; ?>"/><br/>
     
    </figure>
   <article id="descrip">
    <?php print "<strong>".$meuble[0]->nom_modele."</strong>";?></br>
    <?php print "Prix <strong>".$meuble[0]->prix."</strong> &nbsp;&euro;";?><br/></br>
    <?php print "<strong> Ref: </strong> ".$meuble[0]->ref;?><br/>
    <?php $idCouleur= $meuble[0]->id_couleur;
          $mg3=new CouleurManager($db);
          $couleur=$mg3->getCouleur($idCouleur);
          print "<strong>Couleur: </strong>".$couleur[0]->couleur;?></br>
    <?php $idMater= $meuble[0]->id_mat;
          $mg4= new MateriauManager($db);
          $mater= $mg4->getMateriau($idMater);
          print "<strong> Materiau: </strong>".$mater[0]->type_mat;?></br></br>
    <?php print "<strong> Dimensions  </strong>";?></br>
    <?php $idDim= $meuble[0]->id_dim;
          $mg5= new DimensionManager($db);
          $dimen= $mg5->getDimension($idDim);
          print "<strong>Largeur: </strong>".$dimen[0]->largeur;?></br>
    <?php print "<strong>Hauteur: </strong>".$dimen[0]->hauteur;?></br>
    <?php print "<strong>Profondeur: </strong>".$dimen[0]->profondeur;?></br></br>
          
    <?php print "<strong>Description: </strong></br>".$meuble[0]->desc_modele;?></br></br>
  
       <input class="aj_panier" type="submit" name="vers_panier" id="ajout_panier" value="Ajouter au panier" />  
   
    
                
                
    
   <?php 
}
?>
    </article> 
    
</section>
<a href="index.php?page=accueil.php" class="lien">&lt;&lt;Retour</a>



<?php
/*if(isset($_POST['descr'])){
    print "essai 2";
    print "<br/>".$_POST['descr']; 
   $s=$_POST['descr'];
  
}*/

?>
