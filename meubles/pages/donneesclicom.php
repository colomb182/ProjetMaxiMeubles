
<?php
$idadrlv = 0;
$livrer = 0;
$idcom = 0;
$modele = 0;
$lignecomp = 0;

if (isset($_SESSION['client'])) {
    $mg1 = new ClientManager($db);
    $client = $mg1->getClientId($_SESSION['client']);


    $mg2 = new VilleManager($db);
    $ville = $mg2->getVille($client[0]->id_ville);
    $mg3 = new PaysManager($db);
    $pays = $mg3->getPays($ville[0]->id_pays);



    if (isset($_POST['adresslivrcontact'])) {
        $mg2 = new AdresselivrManager($db);
        $idadrlv = $mg2->addAdresseLivr($client[0]->id_ville, $client[0]->rue, $client[0]->num);
        if ($idadrlv != 0) {
            $mg4 = new LivrerManager($db);
            $livrer = $mg4->addAdresseLivr($client[0]->id_client, $idadrlv);
            $mgpanier = new PanierManager($db);
            $listeprod = $mgpanier->getListeProduits($client[0]->id_client);
            $mgcom = new CommandeManager($db);
            $idcom = $mgcom->addCommande($client[0]->id_client, $idadrlv, 'Commande');
            $mgmodele = new ModeleManager($db);
            $mgcomporte = new ComporteManager($db);
            $totalcom = 0;
            for ($i = 0; $i < count($listeprod); $i++) {
                $modele = $mgmodele->getModele($listeprod[$i]->id_modele);
                $lignecomp = $mgcomporte->addLigneComp($idcom, $modele[0]->id_modele, $listeprod[$i]->quantiteprod, $modele[0]->prix);

                $totalcom+=$modele[0]->prix * $listeprod[$i]->quantiteprod;
            }
            $majcom = $mgcom->updatePrixCom($idcom, $totalcom);
            $majpancli = $mgpanier->suppPanierCli($client[0]->id_client);
        }

        header('Location: http://localhost/ProjetMaxiMeubles/meubles/index.php?page=confirmcommande');
    }
    if (isset($_POST['adresslivrautre'])) {
        header('Location: http://localhost/ProjetMaxiMeubles/meubles/index.php?page=newadresselv');
    }
    ?>

    <section class="infosclicom">
        <fieldset>
            <table id="donnees">
                <tr><th colspan="2">Vos données personnelles</th></tr>
                <tr><th><label for="lbnom" >Nom</label></th>
                    <td><label for="nom" ><?php print $client[0]->nom; ?></label></td>
                </tr>
                <tr><th><label for="lbprenom">Pr&eacute;nom</label></th>
                    <td><label for="prenom"><?php print $client[0]->prenom; ?></label></td>
                </tr> 
                <tr><th><label for="lbemail">E-mail</label></th>
                    <td><label for="email"><?php print $client[0]->email; ?></label></td>
                </tr>
                <tr><th><label for="lbtel">T&eacute;l&eacute;phone</label></th>
                    <td><label for="tel"><?php print $client[0]->telephone; ?></label></td></tr>
                <tr><th><label for="lbrue">Rue</label></th>
                    <td><label for="rue"><?php print $client[0]->rue; ?></label></td>
                </tr>
                <tr><th><label for="lbnumero">Numero</label></th>
                    <td><label for="rue"><?php print $client[0]->num; ?></label></td>
                </tr>
                <tr><th><label for="lbcodepostal">Code postal</label></th>
                    <td><label for="codepostal"><?php print $ville[0]->codepostal; ?></label></td>
                </tr>
                <tr><th><label for="lblocalite">Localit&eacute;</label></th>
                    <td><label for="localite"><?php print $ville[0]->localite; ?></label></td>
                </tr>
                <tr><th><label for="lbpays">Pays</label></th>
                    <td><label for="pays"><?php print $pays[0]->nom_pays; ?></label></td>
                </tr>


            </table>
        </fieldset>
    </section>




    <section class="infosclicom">  
        <form  method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" id="choix" >

            <table> 
                <tr><h4>Votre adresse de livraison</h4></tr>
                <tr>
                <INPUT type= "radio" name="adresslivrcontact" value="adresse_liv_contact"/> Idem à l'adresse de contact</br>   
                </tr>  
                <tr>
                <INPUT type= "radio" name="adresslivrautre" value="adresse_liv_autre"/> J'ai une autre adresse de livraison</br>    
                </tr>  
                <tr>
                    <td colspan="2">  
                        <button type="submit" name="confirmcom" class="btn btn-success" >Suivant</button>
                    </td>
                </tr>
            </table> 
        </form>

    </section>

    <?php
}
?>     
