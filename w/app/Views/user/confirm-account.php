<?php $this->layout('layout', ['title' => 'Confirmation de compte']) ?>

<?php $this->start('main_content') ?>

    <nav>
        <?php if(!empty($_SESSION['user'])) : ?>
            <h3>Vous n'avez pas accès à cette page lorsque vous êtes connecté !</h3>
        <?php endif ?>
        <a class="btn btn-default" href="<?= $this->url('default_home') ?>">
            < Retour à l'accueil
        </a>
    </nav>

<?php if(!isset($_SESSION['user'])) : ?>
    <form action="" method="POST">
        <button type="submit" name="confirm-account" class="btn btn-primary">Confirmer votre compte !</button>
    </form>
<?php endif ?>

<?php $this->stop('main_content') ?>