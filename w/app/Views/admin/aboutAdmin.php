<?php $this->layout('layout', ['titre'=>'Contact'])  ?>

<!-- début du bloc main_content -->
<?php $this->start('main_content'); ?>


<h2>Modifier votre contenu :</h2>
<form enctype="multipart/form-data" action="#" method="post">
	<div class="input-group">
		<label class="control-label">Sélectionner un fichier pour votre logo :</label>
		<input id="input-1" type="file" name="my-logo" class="file">
		
		<label class="control-label">Contenu page A propos :</label>
		<textarea class="form-control" rows="5" name="aboutContent">
		<?php if(isset($_POST['sendOptions'])) :
					echo $content;
				else :
					echo $aboutContent;
				endif ?>
		</textarea>
	</div>
	<input type="submit" class="sendOptions" name="sendOptions" value="Modifier">
</form>

<?php if(isset($confirmedLegend)) : ?>
	<?= $confirmedLegend ?>
<?php endif ?>
<br>
<?php if(isset($errors['files'])) : ?>
	<?= $errors['files'] ?>

<?php endif ?>

<?php $this->stop('main_content'); ?>