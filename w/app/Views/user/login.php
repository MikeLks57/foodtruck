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
            <a class="btn btn-default" href="<?= $this->url('default_home') ?>">
                 < Retour à l'accueil
            </a>
    </nav>

    <?php if(empty($user)) : ?>
        <div class="form-group">
            <div  id="connectDiv">
                <form action="<?= $this->url('user_login') ?>" method="post">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
                        <input type="text" name="mail" class="form-control" placeholder="E-mail" aria-describedby="sizing-addon1">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon1">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcFdA8UAAAAAJOeg7RqXtyYLrm2GkdiSE3wjm3O"></div>
                    <br><br>
                    <button type="submit" name="login" class="btn btn-info">Connexion</button>
                </form>
            </div>
        </div>
    <?php endif ?>
<?php $this->stop('main_content') ?>
