<h2 style="text-align: center;">Liste des meubles</h2>
<?php
if(isset($_POST['choix'])){
   //print " page avec les meubles 2<br/>".$_POST['choix'];
   $s=$_POST['choix'];
   $_SESSION['choixcategorie'] = $s;
   //print " session<br/>". $_SESSION['choixcategorie'];
   $mg2 = new ModeleManager($db);
   //$meubles = $mg2->getListeSelection($_POST['choix']);
   $tabMeuble = $mg2->getListeSelection($_POST['choix']);
   $nbr_meubles = count($tabMeuble);
}
if (isset($_SESSION['choixcategorie'])){
    $mg2 = new ModeleManager($db);
    //$meubles = $mg2->getListeSelection($_SESSION['choixcategorie']);
    $tabMeuble = $mg2->getListeSelection($_SESSION['choixcategorie']);
    $nbr_meubles = count($tabMeuble);  
}
if(isset($_GET['numPage']))
{
   /*echo "<br/>".$_GET['descr'];*/
  $pageCourante=$_GET['numPage'];
}
else if(isset($_POST['numPage'])){
   $pageCourante=$_POST['numPage'];
}
else{
    $pageCourante = 1;
}
//Il faut à nouveau aller rechercher les informations ici

$nbreParPage = 6;
$nbreMeubleTot = count($tabMeuble);
$nbrePage = ceil($nbreMeubleTot / $nbreParPage);
$meubles = $mg2->getListeModelePage($_SESSION['choixcategorie'],$nbreParPage,($pageCourante-1)*$nbreParPage);
//print count($tabAffiche);

 
?>


<section id="produit">
<?php
if (isset($nbr_meubles)) {
    ?>
    <ul>
        <?php
        for ($i = 0; $i <count($meubles); $i++) {
            ?>
        <li class="titreproduit"><a href="index.php?page=meubledesc&amp;descr=<?php print $meubles[$i]->id_modele;?>"><?php print $meubles[$i]->nom_modele;?> </a>
            <img src="../admin/images/<?php print $meubles[$i]->photop; ?>" alt="<?php print $meubles[$i]->nom_modele; ?>" />
            
        <?php
         print "Prix <strong>".$meubles[$i]->prix."</strong> &nbsp;&euro;";?><br/>
         <a href="index.php?page=meubledesc&amp;descr=<?php print $meubles[$i]->id_modele;?>">D&eacute;tails</a>
        </li>
        <?php
    }
    ?>      
    </ul>
        <?php
    }
    ?>
</section>
<nav style="text-align: center;">
    <ul class="pagination">
        <?php
        if($pageCourante>1){ ?>
        <li>
            <a href="index.php?page=catmeubles&amp;numPage=<?php print $pageCourante-1;?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
        }
        for ($i = 1; $i <= $nbrePage; $i++) {
            ?>
            <li><a href="index.php?page=catmeubles&amp;numPage=<?php print $i;?>"><?php print $i; ?></a></li>
            <?php
        }
        if($pageCourante!=$nbrePage){
        ?>
        <li>
            <a href="index.php?page=catmeubles&amp;numPage=<?php print $pageCourante+1;?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>

