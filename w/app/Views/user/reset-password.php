<?php $this->layout('layout', ['title' => 'Réinitialisation du mot de passe']) ?>

<?php $this->start('main_content') ?>

    <nav>
        <?php if(!empty($_SESSION['user'])) : ?>
            <h3>Vous n'avez pas accès à cette page lorsque vous êtes connecté !</h3>
        <?php endif ?>

        <a class="btn btn-default" href="<?= $this->url('default_home') ?>">
            < Retour à l'accueil
        </a>
    </nav>

    <section class="login">
        <form action="#" method="post">
            <fieldset>
                <input type="password" name="password" placeholder="Nouveau mot de passe">
                <input type="password" name="password-confirm" placeholder="Confirmation">
            </fieldset>
            <button type="submit" name="update-password">Modifier le mot de passe</button>
        </form>
    </section>

<?php $this->stop('main_content') ?>