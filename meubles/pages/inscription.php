<script type="text/javascript">
    function verifform() {
        if (document.formulaire.nom.value === "") {
            alert("Veuillez entrer votre nom!");
            document.formulaire.nom.focus();
            return false;
        }
        if (document.formulaire.prenom.value === "") {
            alert("Veuillez entrer votre prénom!");
            document.formulaire.prenom.focus();
            return false;
        }
        if (document.formulaire.rue.value === "") {
            alert("Veuillez entrer votre adresse!");
            document.formulaire.rue.focus();
            return false;
        }
        if (document.formulaire.codePostal.value === "") {
            alert("Veuillez entrer votre code postal!");
            document.formulaire.codePostal.focus();
            return false;
        }
        if (document.formulaire.localite.value === "") {
            alert("Veuillez entrer votre localité!");
            document.formulaire.localite.focus();
            return false;
        }
        if (document.formulaire.pays.value === "") {
            alert("Veuillez entrer votre localité!");
            document.formulaire.localite.focus();
            return false;
        }
        if (document.formulaire.tel.value === "") {
            alert("Veuillez entrer votre localité!");
            document.formulaire.localite.focus();
            return false;
        }
        if (document.formulaire.email.value === "") {
            alert("Veuillez entrer votre adresse électronique!");
            document.formulaire.email.focus();
            return false;
        }
        var x = document.forms["formulaire"]["email"].value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
            alert("Adresse e-mail non valide!");
            return false;
        }
        if (document.formulaire.pass.value === "") {
            alert("Veuillez entrer votre mot de passe");
            return false;
            document.formulaire.pass.focus();
        }
    }
</script>
<?php
if (isset($_POST['inscription'])) {
    extract($_POST, EXTR_OVERWRITE);
    $mgpays = new PaysManager($db);
    $retour1 = $mgpays->addPays($pays);
    if ($retour1 != 0) {
        $mgville = new VilleManager($db);
        $retour2 = $mgville->addVille($retour1, $codePostal, $localite);
        $mgcli = new ClientManager($db);
        $retour3 = $mgcli->addClient($retour2, $_POST);
        if($retour3==2){
            $erreur="Cet email exist déjà!!!";
        } 
        else { 
        ?>   
        <script>alert("Inscription réussie!");</script>
         <?php    
         header('Location: http://localhost/ProjetMaxiMeubles/meubles/index.php?page=connexionclient');
            
        }
    }

   
}
?>

<section id="titreinscrip">
    <p>Vous souhaitez commander en ligne vos meubles? Alors, inscrivez-vous sur notre site MaxiMeubles et 
        profitez de nos meilleures offres.
    </p>  
</section>
<section id="resultat" class="txtRouge"><?php if (isset($erreur)) print $erreur; ?></section>
<section id="inscripcli">

    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" name="formulaire" onSubmit="return verifform()">
        <fieldset><legend>Inscrivez-vous</legend>
            <table>
                <tr><th><label for="nom">Nom(*)</label></th>
                    <td><input type="text" name="nom" id="nom"/></td>
                </tr>
                <tr><th><label for="prenom">Prénom(*)</label></th>
                    <td><input type="text" name="prenom" id="prenom"/></td>
                </tr>
                <tr><th><label for="rue">Rue(*)</label></th>
                    <td><input type="text" name="rue" id="rue"/></td>
                </tr>
                <tr><th><label for="num">Num</label></th>
                    <td><input type="text" name="num" id="num"/></td>
                </tr>
                <tr><th><label for="codePostal">Code Postal(*)</label></th>
                    <td><input type="text" name="codePostal" id="codePostal"/></td>
                </tr>
                <tr><th><label for="localite">Localité(*)</label></th>
                    <td><input type="text" name="localite" id="localite"/></td>
                </tr>
                <tr><th><label for="pays">Pays(*)</label></th>
                    <td><input type="text" name="pays" id="pays"/></td>
                </tr>
                <tr><th><label for="tel">Télephone(*)</label></th>
                    <td><input type="text" name="tel" id="tel"/></td>
                </tr>
                <tr><th><label for="email">E-mail(*)</label></th>
                    <td><input type="text" name="email" id="email"/></td>
                </tr>
                <tr><th><label for="pass">Mot de passe(*)</label></th>
                    <td><input type="password" name="pass" id="pass"/></td>
                </tr>
                <tr><td><button type="submit" name="inscription" class="btn btn-success" >S'inscrire</button>
                    </td>
                    <td><button type="reset" name="annuler" class="btn btn-success" >Annuler</button>
                    </td>
                </tr>
            </table>
        </fieldset>   
    </form>
    <p>(*)Champs requis</p>   

</section>