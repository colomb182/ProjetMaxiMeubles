<h2>D&eacute;couvrez nos cat&eacute;gories</h2>
<p style="text-align: center;">
    Imprimer le catalogue ici
    <a href="./pages/print_meubles.php" target="_blank"><img src="../admin/images/pdficon.png" alt="pdf"/></a>
</p>
<?php
$mg = new CategorieManager($db);
$liste_der = $mg->getListeCategorie();
//nombre d'élt du tableau de resultset
$nbr = count($liste_der);

if (isset($_GET['envoi_choix'])) {
    $mg2 = new ModeleManager($db);
    $meubles = $mg2->getListeSelection($_GET['choix']);
    $nbr_meubles = count($meubles);
}
?>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
    <table>
        <tr>
            <td>
                <select name="choix" id="choix"> 
                    <option value="">Faites votre choix</option>
                    <?php
                    for ($i = 0; $i < $nbr; $i++) {
                        ?>
                        <option value="<?php print $liste_der[$i]->id_cat; ?>">
                            <?php print $liste_der[$i]->nom_cat; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <input type="submit" name="envoi_choix" value="Go" id="envoi_choix"/>                
            </td>
        </tr>
    </table>
</form>
<section id="produit">
<?php
if (isset($nbr_meubles)) {
    ?>
    <ul>
        <?php
        for ($i = 0; $i < $nbr_meubles; $i++) {
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
