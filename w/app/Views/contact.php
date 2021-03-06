<?php $this->layout('layout', ['titre'=>'Contact'])  ?>

<!-- début du bloc main_content -->
<?php $this->start('main_content'); ?>


<?php 

require_once '../vendor/autoload.php'; ?>

<section>

  <!-- Formulaire de contact -->
  <form method="POST" action="#" class="form-inline">
   <!-- Nom -->

   <div class="form-group">
    <label for="exampleInputName">Nom</label>
    <input type="text" name="lastname" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
    <?php if (isset($errors['lastname'])) : ?>
      <div class="error"><?= $errors['lastname'] ?></div>
    <?php endif; ?>
  </div><br><br>


  <!-- Email -->
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <input type="email" name="mail" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
    <?php if (isset($errors['mail'])) : ?>
      <div class="error"><?= $errors['mail'] ?></div>
    <?php endif; ?>
  </div><br><br>


  <!-- Objet -->
  <div class="form-group">
    <label for="exampleInputObject">Objet</label>
    <input type="text" name="object" class="form-control" placeholder="Objet">
    <?php if (isset($errors['object'])) : ?>
      <div class="error"><?= $errors['object'] ?></div>
    <?php endif; ?>
  </div><br><br>


  <!-- Message de la personne -->
  <div class="form-group">
    <label for="exampleInputMessage">Votre message</label>
    <textarea class="form-control" name="textarea" rows="3" placeholder="Votre message..."></textarea>
    <?php if (isset($errors['textarea'])) : ?>
      <div class="error"><?= $errors['textarea'] ?></div>
    <?php endif; ?>
  </div><br><br>


  <!-- Checkbox pour avoir une copie du mail si elle est cochée -->
  <div>
    <label for="checkbox">
      <input name="checkbox" type="checkbox"> Recevoir une copie
    </label>
  </div><br><br>


  <!-- Bouton -->
  <button type="submit" name="send_message" class="btn btn-default">Envoyer</button>
</form>
<!-- Fin du formulaire -->
<br><br>
<?php

if (isset($formValid) && $formValid)
{
  echo "Votre message a bien été envoyé.";
}

?>
<br><br>
  
</section>

<?php $this->stop('main_content'); ?>