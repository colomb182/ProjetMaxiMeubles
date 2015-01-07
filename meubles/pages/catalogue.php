<h2>Découvrez nos catégories</h2>
<p style="text-align: center;">
    Imprimer le catalogue ici

    <a href="./pages/print_meubles.php"><img src="../admin/images/pdficon.png" alt="pdf"/></a>
</p>
<?php
$mg = new CategorieManager($db);
$liste_der = $mg->getListeCategorie();
//nombre d'élt du tableau de resultset
$nbr = count($liste_der);
?>
<form action="<?php print $_SERVER['PHP_SELF']; ?>?page=catmeubles" method="post"> 
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
