

<script type="text/javascript">
  function verifform(){
      if(document.formulaire.rue.value===""){
          alert("Veuillez entrer la rue!");
          document.formulaire.rue.focus();
          return false;
      }
      if(document.formulaire.numero.value===""){
          alert("Veuillez entrer le numéro!");
          document.formulaire.numero.focus();
          return false;
      }
      if(document.formulaire.codepostal.value===""){
          alert("Veuillez entrer le code postal!");
          document.formulaire.codepostal.focus();
          return false;
      }
      if(document.formulaire.localite.value===""){
          alert("Veuillez entrer la localité!");
          document.formulaire.localite.focus();
          return false;
      }
      if(document.formulaire.localite.value===""){
           alert("Veuillez entrer votre localité!");
           document.formulaire.localite.focus();
           return false;
       }
       if(document.formulaire.pays.value===""){
           alert("Veuillez entrer le pays!");
           document.formulaire.pays.focus();
           return false;
       }
 }
 </script>
 
<?php
$erreur=0;
if(isset($_POST['confirmcom'])) {   
    extract($_POST,EXTR_OVERWRITE);
        $mg1=new PaysManager($db);
        $idpays=$mg1->addPays($pays); print $idpays;
        if($idpays!=0){
            $mg2=new VilleManager($db);
            $idville=$mg2->addVille($idpays, $codepostal, $localite);
            //print $retour2;
            if($idville!=0){
                $mg3=new AdresselivrManager($db);
                $idadrl=$mg3->addAdresseLivr($idville, $rue, $numero);
               if($idarl!=0){
                   $_SESSION['adressliv']=$idadrl;
               }
                else{
                    $erreur=1;//print $idadrl;
                }
            }
            else{
                $erreur=1;
            }
        }
        else{
            $erreur=1;
        }
        if ($erreur==1){
            print "un problème est survenu";
        } 
 header('Location: http://localhost/ProjetMaxiMeubles/meubles/index.php?page=confirmcommande');
      
 }
 ?>

<section class="infosclicom">  
        <form  method="post" action="<?php print $_SERVER['PHP_SELF'];?>" name="formulaire" id="newadresselv" onSubmit="return verifform()">
      <table>          
          <tr> <th colspan="2">Entrez votre nouvelle adresse</th></tr></br>     
          <tr><th><label for="lbrue">Rue</label></th>
                    <td><?php if (isset($_SESSION['form']['rue'])) { ?>
                            <input type="text" name="rue" id="rue" value="<?php print $_SESSION['form']['rue']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="rue" id="rue"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr> 

                <tr><th><label for="lbnumero">Numero</label></th>
                    <td><?php if (isset($_SESSION['form']['numero'])) { ?>
                            <input type="text" name="numero" id="numero" value="<?php print $_SESSION['form']['numero']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="numero" id="numero"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr><th><label for="lbcodepostal">Code postal</label></th>
                    <td><?php if (isset($_SESSION['form']['codepostal'])) { ?>
                            <input type="text" name="codepostal" id="codepostal" value="<?php print $_SESSION['form']['codepostal']; ?>"/>
        <?php
    } else {
        ?>
                            <input type="text" name="codepostal" id="codepostal"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr><th><label for="lblocalite">Localit&eacute;</label></th>
                    <td><?php if (isset($_SESSION['form']['localite'])) { ?>
                            <input type="text" name="localite" id="localite" value="<?php print $_SESSION['form']['localite']; ?>"/>
        <?php
    } else {
        ?>
                            <input type="text" name="localite" id="localite"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr><th><label for="lbpays">Pays</label></th>
                    <td><?php if (isset($_SESSION['form']['pays'])) { ?>
                            <input type="text" name="pays" id="pays" value="<?php print $_SESSION['form']['pays']; ?>"/>
        <?php
    } else {
        ?>
                            <input type="text" name="pays" id="pays"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>  

                <tr>
                    <td colspan="2">  
                        <button type="submit" name="confirmcom" class="btn btn-success" >Confirmer commande</button>
                    </td>
                </tr>
            </table>

        </form>
    </section>

