<?php foreach($command as $nbProduct => $product) : ?>
	
	<ul>
		<h3><?php echo $product['name_product'] ?></h3><br>
		
		<h4>Suppléments : </h4>
		
		<?php foreach ($product['supplements'] as $supplement): ?>

			<?php if ($supplement != '0'): ?>

				<li><?php echo $supplement ?></li> 

			<?php endif ?>
		
		<?php endforeach ?>

	</ul><br>
	<button type="submit" name="delete" data-id="<?php echo $nbProduct ?>" class="delete">X</button>
<?php endforeach ; ?>
<a href="<?php echo $this->url('add_order') ?>"><button type="submit" name="addOrder">Finaliser la commande</button></a>