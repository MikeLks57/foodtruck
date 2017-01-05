<?php $this->layout('layout', ['title' => 'S\'inscrire']) ?>

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

    <h2>Formulaire d'inscription</h2>
        <form action="#" method="POST">

            <fieldset>
                <?php if(isset($errors['pseudo']['empty'])) : ?>
                    <p class="text-danger">Votre pseudo est vide</p>
                <?php endif ?>
                <?php if(isset($errors['pseudo']['exist'])) : ?>
                    <p class="text-danger">Ce pseudo est déjà pris</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" name="pseudo" class="form-control" placeholder="Choisir un pseudo" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['lastname']['empty'])) : ?>
                    <span class="glyphicon glyphicon-hand-right">
                        <p class="text-danger">Remplir votre nom</p>
                    </span>

                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
                    <input type="text" name="lastname" class="form-control" placeholder="Nom" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['firstname']['empty'])) : ?>
                    <p class="text-danger">Remplir votre prénom</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
                    <input type="text" name="firstname" class="form-control" placeholder="Prénom" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['phone']['empty'])) : ?>
                    <p class="text-danger">Remplir votre numéro de téléphone portable</p>
                <?php endif ?>
                <?php if(isset($errors['phone']['invalid'])) : ?>
                    <p class="text-danger">Remplir avec un numéro de téléphone portable (06 ou 07)</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-phone"></span></span>
                    <input type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="N° de téléphone portable" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['mail']['empty'])) : ?>
                    <p class="text-danger">Remplir votre adresse mail</p>
                <?php endif ?>
                <?php if(isset($errors['mail']['bad'])) : ?>
                    <p class="text-danger">Remplir avec une adresse mail valide</p>
                <?php endif ?>
                <?php if(isset($errors['mail']['exist'])) : ?>
                    <p class="text-danger">Ce pseudo est déjà pris</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input type="text" name="mail" class="form-control" placeholder="Adresse email" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['password']['empty'])) : ?>
                    <p class="text-danger">Remplir le mot de passe</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon1">
                </div>

                <?php if(isset($errors['password2']['empty'])) : ?>
                    <p class="text-danger">Confirmer votre mot de passe</p>
                <?php endif ?>
                <?php if(isset($errors['confirmPass'])) : ?>
                    <p class="text-danger">La confirmation ne correspond pas à votre mot de passe.</p>
                <?php endif ?>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="password2" class="form-control" placeholder="Confirmer votre mot de passe" aria-describedby="sizing-addon1">
                </div>
                <br>
                <?php if(isset($errors['captcha']['check'])) : ?>
                    <p class="text-danger">Veuillez vérifier votre humanité.</p>
                <?php endif ?>
                <div class="g-recaptcha" data-sitekey="6LcFdA8UAAAAAJOeg7RqXtyYLrm2GkdiSE3wjm3O"></div>
            </fieldset>
            <button type="submit" name="add-user" class="btn btn-default">S'inscrire</button>
        </form>
<?php endif ?>

<?php $this->stop('main_content') ?>