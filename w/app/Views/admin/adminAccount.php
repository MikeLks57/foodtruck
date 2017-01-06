<?php $this->layout('admin-layout', ['title' => 'Réinitialisation du mot de passe']) ?>

<?php $this->start('main_content') ?>
<!-- Input déclanchant le script JS -->
<input type="hidden" id="admin">


<section class="account">
    <form action="#" method="post">
        <fieldset>

            <div class="input-group">
                <span class="input-group-addon" id="sizing-addon2">Mot de passe:</span> <input type="password" name="password" class="form-control" aria-describedby="sizing-addon2" />
            </div>
            <?php if(isset($errors['password']['empty'])) : ?>
                <p class="text-danger">Merci de remplir le mot de passe.</p>
            <?php endif ?>

            <div class="input-group">

                <span class="input-group-addon" id="sizing-addon2">Confirmer mot de passe:</span> <input type="password" name="confirmPass" class="form-control" aria-describedby="sizing-addon2" />
            </div>
            <?php if(isset($errors['confirmPass']['empty'])) : ?>
                <p class="text-danger">Merci de confirmer votre mot de passe.</p>
            <?php endif ?>
            <?php if(isset($errors['confirmPass'])) : ?>
                <p class="text-danger">La confirmation ne correspond pas à votre mot de passe.</p>
            <?php endif ?>


        </fieldset>
        <button type="submit" name="update-password" class="adminAccountBtn btn btn-default">Modifier vos informations</button>
    </form>
</section>

<?php $this->stop('main_content') ?>