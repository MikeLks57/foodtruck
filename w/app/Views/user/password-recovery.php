<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>

<?php $this->start('main_content') ?>

    <nav>
        <?php if(!empty($user)) : ?>
            <h3>Vous n'avez pas accès à cette page lorsque vous êtes connecté !</h3>
        <?php endif ?>
        <a class="btn btn-default" href="<?= $this->url('default_home') ?>">
            < Retour à l'accueil
        </a>
    </nav>

<?php if(!isset($_SESSION['user'])) : ?>
    <section class="login">
        Pour réinitialiser votre mot de passe, entrez votre adresse mail :
        <form action="#" method="post">
            <fieldset>
                <input type="text" name="mail" placeholder="E-mail">
            </fieldset>
            <button type="submit" name="send-mail">Envoyer un mail de réinitialisation</button>
        </form>
    </section>
<?php endif ?>

<?php $this->stop('main_content') ?>