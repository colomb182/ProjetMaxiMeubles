<?php
$mg = new CommandeManager($db);

if (isset($s) && isset($_SESSION['client'])) {
    //print $s;

}
$mg2 = new PanierManager($db);
$verifretour= $mg2->verifListeProduit($_SESSION['client']);
if($verifretour>0){
$listeproduits = $mg2->getListeProduits($_SESSION['client']);
//var_dump($listeproduits);
$mod = new ModeleManager($db);
$totaux=array();
?>

<section class="forms_comm" >
    <table border="1">
        <tr>
            <td colspan="6"><strong>Résumé de votre commande</strong></td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>Quantité</th>
            <th>Prix par pièce</th>
            <th>Total</th>
            
        </tr>
<?php
for ($i = 0; $i < count($listeproduits); $i++) {
    $modele = $mod->getModele($listeproduits[$i]->id_modele);
    ?>
        <tr>
            <td >
                <img src="../admin/images/<?php print $modele[0]->photop; ?>" alt="<?php print $modele[0]->nom_modele;?>"style="width:100px;height:100px;"/>
            </td>
            <td>
                <?php print "<strong>".$modele[0]->nom_modele."</strong>";?></br>
                <?php print $modele[0]->desc_modele;?></br>
                <?php $idCouleur= $modele[0]->id_couleur;
                      $mg3=new CouleurManager($db);
                      $couleur=$mg3->getCouleur($idCouleur);
                      print "Couleur: ".$couleur[0]->couleur;?></br>
                      
            </td>
             <td>
                <?php print $listeproduits[$i]->quantiteprod;?>
            </td>
            <td>
                <?php print $modele[0]->prix;?>&nbsp;&euro;
            </td>
            <td>
                <?php
                $total=$modele[0]->prix*$listeproduits[$i]->quantiteprod;
                $totaux[$i]=$total;
                print $total."&nbsp;&euro;";
                ?>
                
            </td>
           
        </tr>
    <?php
}
?>
        <tr>
            <td colspan="3"></td>
            <td><strong>Total</strong></td>
            <td>
                <?php 
                $prixtotal=0;
                for($j=0;$j<count($totaux);$j++){
                 $prixtotal+=$totaux[$j];
                }
                print $prixtotal."&nbsp;&euro;";
                ?>
            </td>
            
        </tr>
    </table>
   
    <form method="post" action="<?php print $_SERVER['PHP_SELF'];?>?page=panier" style="text-align:center" >
        <button type="submit" class="btn btn-success" >Modifier</button>
    </form>
     <form method="post" action="<?php print $_SERVER['PHP_SELF'];?>?page=donneesclicom" style="text-align:center" >
        <button type="submit" class="btn btn-success" >Suivant</button>
    </form>
<?php 
}
else {
    ?>

<h2>Il n'y a aucun produit dans votre panier.</h2>

<p>      Cliquez <a href="index.php?page=catalogue">ici</a> pour revenir au catalogue. </p>
<?php
}
?>

</section>








