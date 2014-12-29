<h2>D&eacute;couvrez nos cat&eacute;gories</h2>
<?php
$mg = new CategorieManager($db);
$liste_der = $mg->getListeCategorie();
//nombre d'élt du tableau de resultset
$nbr = count($liste_der);

if (isset($_GET['envoi_choix'])) {
    $mg2 = new ModeleManager($db);
    $meubles = $mg2->getListeSelection($_GET['choix']);
    $nbr_at = count($meubles);
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

<?php
if (isset($nbr_at)) {
    ?>
    <table>
        <?php
        for ($i = 0; $i < $nbr_at; $i++) {
            ?>
            <tr>
                <td>
                    <img src="../admin/images/<?php print $meubles[$i]->photo; ?>" alt="<?php print $meubles[$i]->nom_modele; ?>" />
                </td>
                <td class="up centrer">
                    <span class="txtBlue txtGras">
        <?php
       print $meubles[$i]->nom_modele . "<br />";
        ?>  
                </td>
            </tr>
        <?php
    }
    ?>      

    </table>
        <?php
    }
    ?>


