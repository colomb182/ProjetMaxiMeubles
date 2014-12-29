<!doctype html>
<?php
include ('./lib/php/Pliste_include.php');
$db = Connexion::getInstance($dsn, $user, $pass);
session_start();
$scripts = array();
$i = 0;
foreach (glob('../admin/lib/js/jquery/*.js') as $js) {
    $scripts[$i] = $js;
    $i++;
}
?>
<html>
    <head>
        <title>MaxiMeubles</title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="../admin/lib/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../admin/lib/css/style_pc.css" />
        <link rel="stylesheet" type="text/css" href="../admin/lib/css/mediaqueries.css" />
        <?php
        foreach ($scripts as $js) {
            ?>
            <script type="text/javascript" src="<?php print $js; ?>">
            </script>
            <?php
        }
        ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="page">
            <section id="rech">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </section>
            <header>
                <img src="../admin/images/banniere12.jpg" alt="meubles" />
            </header>
            <section id="menu">
                <nav>
                    <?php
                    if (file_exists('./lib/php/Pmenu.php')) {
                        include ('./lib/php/Pmenu.php');
                    }
                    ?>
                </nav>
            </section>
            <section id="contenu">
                <div id="main">
                    <?php
                     //quand on arrive sur le site
                    if (!isset($_SESSION['page'])) {
                        $_SESSION['page'] = "accueil";
                    } //si on a cliqué sur un lien du menu
                    if (isset($_GET['page'])) {
                        $_SESSION['page'] = $_GET['page'];
                    }
                    $_SESSION['page'] = $_SESSION['page'];
                    if (file_exists('./pages/' . $_SESSION['page'] . '.php')) {
                        include ('./pages/' . $_SESSION['page'] . '.php');
                    }
                    ?>
                </div>
            </section>
        </section>
        <footer>
            Editeur responsable sitesuperbeaux@condorcet.be
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../admin/lib/js/bootstrap.min.js"></script>
    </body>
</html>



