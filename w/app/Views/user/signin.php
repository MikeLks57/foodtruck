<?php $this->layout('layout', ['title' => 'S\'inscrire']) ?>

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

        <form action="#" method="POST">

            <fieldset>
                <?php if(isset($errors['pseudo']['empty'])) : ?>
                    <p class="text-danger">Votre pseudo est vide</p>
                <?php endif ?>
                <?php if(isset($errors['pseudo']['exist'])) : ?>
                    <p class="text-danger">Ce pseudo est déjà pris</p>
                <?php endif ?>
                <p>Pseudo : <input type="text" name="pseudo"></p>
            </fieldset>

            <fieldset>
                <?php if(isset($errors['lastname']['empty'])) : ?>
                    <span class="glyphicon glyphicon-hand-right">
                        <p class="text-danger">Remplir votre nom</p>
                    </span>

                <?php endif ?>
                <p>Nom: <input type="text" name="lastname"></p>

                <?php if(isset($errors['firstname']['empty'])) : ?>
                    <p class="text-danger">Remplir votre prénom</p>
                <?php endif ?>
                <p>Prénom: <input type="text" name="firstname"></p>

                <?php if(isset($errors['phone']['empty'])) : ?>
                    <p class="text-danger">Remplir votre numéro de téléphone portable</p>
                <?php endif ?>
                <?php if(isset($errors['phone']['invalid'])) : ?>
                    <p class="text-danger">Remplir avec un numéro de téléphone portable (06 ou 07)</p>
                <?php endif ?>
                <p>N° Port.: <input type="tel" name="phone" pattern="[0-9]{10}"></p>

                <?php if(isset($errors['mail']['empty'])) : ?>
                    <p class="text-danger">Remplir votre adresse mail</p>
                <?php endif ?>
                <?php if(isset($errors['mail']['bad'])) : ?>
                    <p class="text-danger">Remplir avec une adresse mail valide</p>
                <?php endif ?>
                <?php if(isset($errors['mail']['exist'])) : ?>
                    <p class="text-danger">Ce pseudo est déjà pris</p>
                <?php endif ?>
                <p>Votre adresse email : <input type="text" name="mail"></p>

                <?php if(isset($errors['password']['empty'])) : ?>
                    <p class="text-danger">Remplir le mot de passe</p>
                <?php endif ?>
                <p>Mot de passe: <input type="password" name="password"></p>

                <?php if(isset($errors['password2']['empty'])) : ?>
                    <p class="text-danger">Confirmer votre mot de passe</p>
                <?php endif ?>
                <?php if(isset($errors['confirmPass'])) : ?>
                    <p class="text-danger">La confirmation ne correspond pas à votre mot de passe.</p>
                <?php endif ?>
                <p>Confirmer mot de passe: <input type="password" name="password2"></p>
                <br>
                <?php if(isset($errors['captcha']['check'])) : ?>
                    <p class="text-danger">Veuillez vérifier votre humanité.</p>
                <?php endif ?>
                <div class="g-recaptcha" data-sitekey="6LcFdA8UAAAAAJOeg7RqXtyYLrm2GkdiSE3wjm3O"></div>
            </fieldset>
            <button type="submit" name="add-user">S'inscrire</button>
        </form>
<?php endif ?>

<?php $this->stop('main_content') ?>