<?php

$erreur=0;

$m=26;
$mg=new ClientManager($db);
$mg2=new AdresselivrManager($db);
$client= $mg->getClientId($_SESSION['client']);
print $_SESSION['client'];
$m=
$adresseliv=$mg2->getAdresseLivre($_SESSION['adressliv']);
print $adresseliv[0]->id_adresseliv;

   /* if(isset($_POST['confirmcom'])){
     print $m;
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
                $adrlv=$idadrl;
                print $adrlv;
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
}*/
if(isset($_POST['adresslivrcontact'])){  //si le client a choisi l'addresse de contact
    //print $m;
    $mg2= new AdresselivrManager($db);
    //print $client[0]->id_ville;
  /*  $id=$mg2->addAdresseLivr($client[0]->id_ville,$client[0]->rue,$client[0]->num);
    $adrlv=$idadrl;
                print $adrlv;*/
 }
 
/*$mg4=new LivrerManager($db);
$retour=$mg4->addAdresseLivr($client[0]->id_client, $adrlv);
        print $retour;
 ?>*/
