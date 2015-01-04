<h2>Recherche</h2>
<?php
if (isset($_POST['motrech'])) {
    $s = $_POST['motrech'];
    $mot = $_POST['motrech'];
    $s = substr_replace($s, "%", 0, 0);
    $s = substr_replace($s, "%", strlen($s), 1);
}
//print $s;
$i = 0;
do {
    if ($s[$i] == ' ') {
        $s = substr_replace($s, "%", $i, 1);
    }
    $i++;
} while ($i < strlen($s));
//print $s;
$mg = new ModeleManager($db);
$listemeubrech = $mg->getListeRechModele($s);
if (count($listemeubrech) > 0) {
    $nbr_meubles = count($listemeubrech);
} else {
    $mg2 = new CategorieManager($db);
    $listecatrech = $mg2->getListeRechCat($s);
    if (count($listecatrech) > 0) {
        $nbr_cat = count($listecatrech);
        $listemeubrech = $mg->getListeSelection($listecatrech[0]->id_cat);
        $nbr_meubles = count($listemeubrech);
    } else {
        print "Résultats de la recherche:<br/>
         Votre recherche pour " . $mot . " n'a pas donné de résultat. ";
    }
}
?>
<section id="produit">
    <?php
    if (isset($nbr_meubles)) {
        ?>
        <ul>
            <?php
            for ($i = 0; $i < $nbr_meubles; $i++) {
                ?>
                <li class="titreproduit"><a href="index.php?page=meubledesc&amp;descr=<?php print $listemeubrech[$i]->id_modele; ?>"><?php print $listemeubrech[$i]->nom_modele; ?> </a>
                    <img src="../admin/images/<?php print $listemeubrech[$i]->photop; ?>" alt="<?php print $listemeubrech[$i]->nom_modele; ?>" />

                    <?php print "Prix <strong>" . $listemeubrech[$i]->prix . "</strong> &nbsp;&euro;"; ?><br/>
                    <a href="index.php?page=meubledesc&amp;descr=<?php print $listemeubrech[$i]->id_modele; ?>">D&eacute;tails</a>
                </li>
                <?php
            }
            ?>      
        </ul>
        <?php
    }
    ?>
</section>

