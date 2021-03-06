<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>

    <!-- polices -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:700|Catamaran|Ranchers" rel="stylesheet">

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= $this->assetUrl('css/admin-style.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="<?= $this->assetUrl('dist/css/bootstrap-tokenfield.css') ?>">

    <script src="https://www.google.com/recaptcha/api.js"></script>

</head>
<body>
<div class="container">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand zoom">
                    <a href="<?= $this->url('admin_home') ?>">

                       <h1 class="h1Menu">Bonjour, <?= $_SESSION["user"]['username']; ?></h1>

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

<footer class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid footer-default text-center">
        <h4 class="text-info">
            Pizz’Truck 2016 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
        </h4>
    </div><!-- <div class="container-fluid footer-default"> -->
</footer>
<!-- Jquery 3.1.1 slim minified -->
<!-- <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
</script>
Bootstrap Latest compiled and minified JavaScript
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
Fichier Script JS -->

<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>
    <!-- Bootstrap Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    
    <!-- Script captcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Fichier Script Tokens JS -->
    <script src="<?= $this->assetUrl('dist/bootstrap-tokenfield.min.js') ?>"></script>
    <!-- Fichier Script JS -->
    <script src="<?= $this->assetUrl('js/script.js') ?>"></script>


<?= $this->section('admin_script') ?>

</body>
</html>