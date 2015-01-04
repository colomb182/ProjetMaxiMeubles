<?php
if (isset($_POST['submit_login'])) {
    $mg = new AdminManager($db);
    $retour = $mg->isAdmin($_POST['login'], md5($_POST['password']));
    if ($retour == 1) {
        $_SESSION['admin'] = 1;
        $message = "Authentifié!";
        header('Location: http://localhost/ProjetMaxiMeubles/admin/index.php?page=accueil');
    } else {
        $message = "Données incorrectes";
    }
}
?>
<section>
    <section id="message"><?php if (isset($message)) print $message; ?></section>
    <fieldset id="fieldset_login">
        <legend>Authentifiez-vous</legend>
        <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth">
            <table>
                <tr>
                    <td>Login:<?php //print " session : ".$_SESSION['admin']; ?></td>
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
            </table>	
        </form>
    </fieldset>
</section>






