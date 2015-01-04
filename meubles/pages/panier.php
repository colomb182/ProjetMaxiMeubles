<?php
$mg = new PanierManager($db);
if (isset($_GET['idmeuble'])) {
    $s = $_GET['idmeuble'];
}
if (isset($_POST['idmeuble'])) {
    $s = $_POST['idmeuble'];
}
if (isset($_GET['idmeubdel'])) {
    $del = $_GET['idmeubdel'];
    $retour2=$mg->suppLignePanier($_SESSION['client'],$del);
}
if (isset($s) && isset($_SESSION['client'])) {
    print $s;
    
    $retour = $mg->addLignePanier($_SESSION['client'], $s, 1);
    if ($retour == 1) {
        
    } else if ($retour == 2) {
        
    } else {
        $message = "pas ajouté";
    }
}
$mg2 = new PanierManager($db);
$verifretour= $mg2->verifListeProduit($_SESSION['client']);
if($verifretour>0){
$listeproduits = $mg2->getListeProduits($_SESSION['client']);
var_dump($listeproduits);
$mod = new ModeleManager($db);
$totaux=array();
?>

    <section id="message"><?php if (isset($message)) print $message; ?></section>
    <table style="width: 700px;text-align:center;" border="1">
        <tr>
            <td colspan="6">Votre panier</td>
        </tr>
        <tr>
            <th>Photo</th>
            <th>Modèle</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
            <th>Action</th>
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
                <?php print $modele[0]->nom_modele;?>
            </td>
            <td>
                <?php print $modele[0]->prix;?>&nbsp;&euro;
            </td>
                 
            <td>
                <?php print $listeproduits[$i]->quantiteprod;?>
            </td>
            <td>
                <?php
                $total=$modele[0]->prix*$listeproduits[$i]->quantiteprod;
                $totaux[$i]=$total;
                print $total."&nbsp;&euro;";
                ?>
                
            </td>
            <td> <a href="index.php?page=panier&amp;idmeubdel=<?php print $modele[0]->id_modele; ?>">
                    <img src="../admin/images/trash.png" alt="trash"/>
                </a>
            </td>
        </tr>
    <?php
}
?>
        <tr>
            <td colspan="4"></td>
            <td>Total:</td>
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
    <form method="post" action="<?php print $_SERVER['PHP_SELF'];?>?page=commander" style="text-align:center" >
        <button type="submit" class="btn btn-success" >Commander</button>
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


