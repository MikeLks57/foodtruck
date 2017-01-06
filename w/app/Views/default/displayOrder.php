<?php foreach($_SESSION['basket'] as $nbProduct => $product) : ?>
	
	<ul>
		<h3>
		<?php echo $product['name_product'] ?> 
			<button type="submit" name="delete" class="delete" data-id="<?php echo $nbProduct ?>" >X</button>
		</h3>
			
		<?php foreach ($product['supplements'] as $supplement): ?>

			<?php if ($supplement != '0'): ?>

				<li> + <?php echo $supplement ?></li> 

			<?php endif ?>
		
		<?php endforeach ?>
	</ul><br>
	
<?php endforeach ; ?>
<?php if (isset($_SESSION['user']) && !isset($_SESSION['basket'])){ ?>
	<button type="submit" name="addOrder">Finaliser la commande</button>
<?php } else { ?>
	<button><a href="<?php echo $this->url('user_login') ?>">Se connecter</a></button>
<?php } ?>