<?php $total = 0 ?>
<?php if (isset($_SESSION['basket']) && $_SESSION['basket'] != null): ?>
	
	<?php foreach($_SESSION['basket'] as $nbProduct => $product) : ?>
		
		<ul class="list-group">
			<h4>
				<?php echo $product['name_product'] ?> 
				<button type="submit" name="delete" class="delete btn btn-default" data-id="<?php echo $nbProduct ?>" ><span class="glyphicon glyphicon-remove"></span></button>
			</h4>
				
			<?php foreach ($product['supplements'] as $supplement): ?>

				<?php if ($supplement != '0'): ?>
					<li class="list-group-item"> + <?php echo $supplement ?></li> 
				<?php endif ?>

			<?php endforeach ?>
		</ul><br>
		
		<?php $total = $total + $product['priceProduct'] + $product['priceSupplement'] ?>

	<?php endforeach ; ?>

	Total: <?php echo $total ?> € <br>

	<input type="hidden" name="total" value="<?php echo $total ?>">
	<div>
		<?php if (isset($_SESSION['user'])){ ?>
			<button type="submit" name="addOrder" class="addOrder">Finaliser la commande</button>
		<?php } else { ?>
			<button><a href="<?php echo $this->url('user_login') ?>">Se connecter</a></button>
		<?php } ?>
	</div>
	
	
<?php endif ?>