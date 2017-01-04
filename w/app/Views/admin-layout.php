<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>

    <!-- polices -->

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="<?= $this->assetUrl('css/admin-style.css') ?>">
</head>
<body>
<div class="container">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?= $this->url('admin_home') ?>">
                        Bonjour, <?= $_SESSION["user"]['username']; ?>
                    </a>
                </li>
                <li>
                    <a href="<?= $this->url('admin_home') ?>">Accueil</a>
                </li>
                <li>
                    <a href="#">Infos Personnelles</a>
                </li>
                <li>
                    <a href="#">Produits</a>
                </li>
                <li>
                    <a href="<?= $this->url('admin_slider') ?>">Slider</a>
                </li>
                <li>
                    <a href="<?= $this->url('admin_display_role') ?>">Utilisateurs</a>
                </li>
                <li>
                    <a href="<?= $this->url('admin_order') ?>">Vos commandes</a>
                </li>
                <li>
                    <a id="disconnect" href="<?= $this->url('user_logout') ?>">Déconnexion</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#menu-toggle" class="btn btn-primary text-center" id="menu-toggle">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </a>
                            <section>
                                <?= $this->section('messages') ?>
                            </section>

                            <section>
                                <?= $this->section('main_content') ?>
                            </section>


                    </div>
                </div>
            </div>
        </div><!-- /#page-content-wrapper -->
    </div><!-- /#wrapper -->
</div><!-- <div class="container"> -->


<footer class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid footer-default text-center">
        <h6>
            ©Pizz’Truck 2016
        </h6>
    </div><!-- <div class="container-fluid footer-default"> -->
</footer>
<!-- Jquery 3.1.1 slim minified -->
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
</script>
<!-- Bootstrap Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Fichier Script JS -->

<?= $this->section('admin_script') ?>

</body>
</html>