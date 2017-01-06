<?php $this->layout('admin-layout', ['title'=>'Modification de la page "A propos"'])  ?>
<!-- début du bloc main_content -->
<?php $this->start('main_content'); ?>

<!-- Input déclanchant le script JS -->
<input type="hidden" id="admin">


<h3 class="titreAboutAdmin">Modifier votre contenu :</h3>
<form enctype="multipart/form-data" id="about-form" action="<?php echo $this->url('admin_about') ?>" method="post">
	<div class="input-group">
		
		<label class="control-label about-admin">Contenu page "A propos" :</label>
		<div id="editeur" contentEditable="true"><?= $allContent['about'] ?></div>
		<input type="hidden" name="aboutContent" id="aboutContent">

	</div>
	<input type="submit" class="sendOptions btn btn-default" name="sendOptions" value="Modifier">
</form>

<?php if(isset($confirmedLegend)) : ?>
	<?= $confirmedLegend ?>
<?php endif ?>
<br>
<?php if(isset($errors['files'])) : ?>
	<?= $errors['files'] ?>

<?php endif ?>

<?php $this->stop('main_content'); ?>