<!doctype html>
<?php
//INDEX ADMIN
include ('./lib/php/liste_include.php');
$db = Connexion::getInstance($dsn,$user,$pass);
session_start();
$scripts=array(); 
$i=0;
foreach(glob('./lib/js/jquery/*.js') as $js) {
    $fichierJs[$i]=$js;
    $i++;
    
}

?>

<html>
<head>
	<title>MaxiMeubles Administration</title>
        <meta charset='UTF-8'/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="../admin/lib/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="../admin/images/faviconmeuble.ico" />
	<link rel="stylesheet" type="text/css" href="./lib/css/style_pc.css"/>
      <!--  <link rel="stylesheet" type="text/css" href="./lib/css/style_jquery.css"/> -->
	<link rel="stylesheet" type="text/css" href="./lib/css/mediaqueries.css"/>
         <?php
            foreach($fichierJs as $js) {
               ?><script type="text/javascript" src="<?php print $js;?>"></script>
            <?php            
            }
            ?>
        <!--<script type="text/javascript" src="./lib/js/fonctionsJqueryAdmin.js"></script> -->
</head>

<body>    
    
    <?php //var_dump($_SESSION);
    //session_destroy();?>
    <section id="page">              
	<header>
            <img src="./images/banniere12.jpg" alt="meubles"/><br />	
            <section id="deconnexion">
                <?php
                    if(isset($_SESSION['admin'])){
                        ?><a href="./lib/php/deconnexionadmin.php">Déconnexion</a>
                    <?php
                    }                   
                ?>
            </section>
            
	</header>
        
        <?php if(!isset($_SESSION['admin'])) { 
            ?>
        <section id="login_form">
            <?php
                 require './pages/connexionadmin.php';  
        ?> </section><?php  
        }
            else {
            
        //print "session : ".$_SESSION['admin'];
        ?>
        <section id="colGauche">
            <nav>
		<ul id="menu_admin"> 
		<?php 
                    if(file_exists('./lib/php/menu.php')){
                        include ('./lib/php/menu.php');
                    }
                ?>
					
		</ul>
            </nav>
	</section>
       
	<section id="contenu">
            
            
            
            <div id="main">
                <?php
               // var_dump($_GET);
               // var_dump($_SESSION);
                if(!isset($_SESSION['page'])) {                    
                    $_SESSION['page'] = "accueil";
                }
                if(isset($_GET['page'])) {
                    $_SESSION['page'] = $_GET['page'];
                }
                $chemin='./pages/'.$_SESSION['page'].'.php';
                if(file_exists($chemin)){

                    include ($chemin);
                }     
                                    //print "ch : ".$chemin;
                ?>                      
            </div>
     
	</section>		

	<footer id="footer_admin">Editeur responsable sitesuperbeaux@condorcet.be</footer>
              <?php 
             }
            ?>
  </body>
 </html>
