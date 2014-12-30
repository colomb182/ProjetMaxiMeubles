<ul id="menu">
<li><a href="index.php?page=accueil">Accueil</a></li>
<li> <a href="index.php?page=catalogue">Catalogue</a></li>
<li> <a href="#">Magasins</a></li>
<li> <a href="#">Panier</a></li>
<?php
    if(isset($_SESSION['client'])){
?>
<li id="borderight"> <a href="./lib/php/deconnexionclient.php">Déconnexion</a></li>
    <?php }
    else {
        ?>
<li id="borderight"> <a href="index.php?page=connexionclient">Se connecter</a></li>
  <?php  }?>
</ul>


