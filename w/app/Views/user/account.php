<?php $this->layout('layout', ['title' => 'Réinitialisation du mot de passe']) ?>

<?php $this->start('main_content') ?>

<section class="account">
    <form action="#" method="post">
        <fieldset>
            <?php if(isset($errors['phone']['empty'])) : ?>
                <p class="text-danger">Remplir votre numéro de téléphone portable</p>
            <?php endif ?>
            <?php if(isset($errors['phone']['invalid'])) : ?>
                <p class="text-danger">Remplir avec un numéro de téléphone portable (06 ou 07)</p>
            <?php endif ?>
            <p>N° Port.: <input type="tel" name="phone" pattern="[0-9]{10}"></p>

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
            <?php if(isset($errors['captcha']['check'])) : ?>
                <p class="text-danger">Veuillez vérifier votre humanité.</p>
            <?php endif ?>
            <div class="g-recaptcha" data-sitekey="6LcFdA8UAAAAAJOeg7RqXtyYLrm2GkdiSE3wjm3O"></div>
        </fieldset>
        <button type="submit" name="update-password">Modifier vos informations</button>
    </form>
</section>

<?php $this->stop('main_content') ?>