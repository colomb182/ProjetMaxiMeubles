<?php
if(isset($_POST['submit_login'])) {
    $mg = new ClientManager($db);
    $retour=$mg->isClient($_POST['login'],md5($_POST['password']));
    if($retour==1) {
        $client = $mg->getClient($_POST['login']);
        $_SESSION['client']=$client[0]->id_client;
        $message="Authentifié!".$client[0]->nom;
        //print $client[0]->nom;
        /*ici on fait redirection*/
        header('Location: http://localhost/ProjetMaxiMeubles/meubles/index.php?page=accueil');
    } 
    else {
        $message="Données incorrectes";
    }
}
?>
<section id="login_form">
<section id="message"><?php if(isset($message)) print $message;?></section>
<fieldset id="fieldset_login">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth">
        <table>
            <tr>
                <td>E-mail:<?php //print " session : ".$_SESSION['admin'];?></td>
                <td><input type="text" id="login" name="login" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" id="password" name="password" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit_login" id="submit_login" value="Login" />
                    <input type="reset" id="annuler" value="Annuler" />
                </td>	
            </tr>
            <tr>
                <td colspan="2">
                    <span id="lieninscrip"><a href="index.php?page=inscription" > Nouvel utilisateur </a></span>
                </td>	
            </tr>
        </table>	
    </form>
</fieldset>
</section>

