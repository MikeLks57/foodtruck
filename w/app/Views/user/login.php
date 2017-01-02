<?php $this->layout('layout', ['title' => 'Connexion']) ?>

<?php $this->start('messages') ?>

<?php if(isset($error)) : ?>
    <dialog open style= " text-align: center;">
        Connexion impossible <br>
        <?php if(isset($error['confirmed']['notconfirmed'])) : ?>
            Votre compte n'a pas été activé, rendez vous dans votre boite mail.<br>
        <?php endif ?>
        <a id='subscription' href="<?= $this->url('user_signin') ?>"> => S'inscrire <= </a>
        <br>
        <a href="<?= $this->url('user_password_recovery') ?>"> => Mot de passe oublié ? <= </a>
    </dialog>
<?php endif ?>
<?php $this->stop('messages') ?>


<?php $this->start('main_content') ?>

    <nav>
        <?php if(!empty($user)) : ?>
            <h3>Vous n'avez pas accès à cette page lorsque vous êtes connecté !</h3>
        <?php endif ?>
        <a href="<?= $this->url('default_home') ?>">
            < Retour à l'accueil
        </a>
    </nav>
    <br>
    <br>
    <?php if(empty($user)) : ?>
        <div class="form-group">
            <div  id="connectDiv">
                <form action="<?= $this->url('user_login') ?>" method="post">
                    <input type="text" name="mail" placeholder="E-mail"><br><br>
                    <input type="password" name="pass" placeholder="Mot de passe"><br><br>
                    <div class="g-recaptcha" data-sitekey="6LcFdA8UAAAAAJOeg7RqXtyYLrm2GkdiSE3wjm3O"></div>
                    <br><br>
                    <button type="submit" name="login">Connexion</button>
                </form>
            </div>
        </div>
    <?php endif ?>
<?php $this->stop('main_content') ?>
