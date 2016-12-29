<?php $this->layout('layout', ['title' => 'Menu']) ?>

<?php $this->start('main_content') ?>
<?php /*session_unset(); session_destroy()*/ ?>

<input type="hidden" id="url_order" value="<?php echo $this->url('add_product_supplement') ?>">
<input type="hidden" id="url_delete" value="<?php echo $this->url('delete_product_supplement') ?>">
<!-- Affichage des catégories -->
<nav>
	<ul>
		<?php foreach ($allCategory as $category): ?>
			<li><a href="<?php echo $this->url('display_menu_category', ['id' => $category['id']]) ?>" title="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></a></li>
		<?php endforeach ?>
	</ul>
</nav>

<!-- Affichage de la liste des produits en fonction de la categorie -->
<div class="col-md-8">
	
	<?php foreach ($allMenu as $menu): ?>

		<h1><?php echo $menu['name'] ?></h1>
		<img src="<?php echo $this->assetUrl('uploads/img/'.$menu['picture']) ?>" alt="<?php echo $menu['name'] ?>">
		<p><?php echo $menu['description'] ?></p>
		<p>Prix : <?php echo $menu['price'] ?> €</p>

		<!-- Boutton ouvrant la boite de dialogue avec le formulaire des supplements -->
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-<?php echo $menu['id'] ?>" name="<?php echo $menu['id'] ?>">Ajouter au panier</button>

		<!-- Boite de dialogue avec le formulaire des supplements -->
		<!-- Modal -->
		<div class="modal fade" id="myModal-<?php echo $menu['id'] ?>" role="dialog">
		  	<div class="modal-dialog">
		    
			    <!-- Modal content-->
		    	<div class="modal-content">
		    		<div class="modal-header">

		    			<button type="button" class="close" data-dismiss="modal">&times;</button>
		    			<h4 class="modal-title"><?php echo $menu['name'] ?></h4>

		    		</div>
		    		<div class="modal-body">
		    		<!-- formulaire affichant la pizza sélectionner puis les select pour les supplements -->
			    		<form action="#" method="POST" accept-charset="utf-8">
			    		
			    			<img src="<?php echo $this->assetUrl('uploads/img/'.$menu['picture']) ?>" alt="<?php echo $menu['name'] ?>"><br>


				    		<?php for ($i=1; $i <= 5 ; $i++) {  ?>
				    			<select name="supplement[]" id="supplement">

				    				Supplément <?php echo $i ?> : 
				    				<option value="0" selected>Sélectioner</option>
				    				<?php foreach ($allSupplement as $supplements): ?>
				    					
										<option value="<?php echo $supplements['name'] ?>">
					    					<?php echo $supplements['name'] ?>
										</option>

									<?php endforeach ?>
								</select><br>
				    		<?php } ?>
			    			<input type="hidden" name="nameProduct" value="<?php echo $menu['name'] ?>">
			    			<input type="submit" name="order" class="order btn btn-default" data-dismiss="modal" value="Ajouter à la commander">
			    			
			    		</form>
		    		</div>
		    		<div class="modal-footer">
		    			<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		    		</div>
		    	</div>

	    	</div>
		</div>
		
	<?php endforeach ?>
</div>

<!-- Affichage de la commande -->
<div class="col-md-4">
	<h2>Ma commande</h2>
	<div>
		<form action="" id="command" method="POST" accept-charset="utf-8">
		
			<?php if (isset($_SESSION['basket'])): ?>
				
				<?php foreach($_SESSION['basket'] as $nbProduct => $product) : ?>
					
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
				<button type="submit" name="addOrder"><a href="<?php echo $this->url('add_order') ?>">Finaliser la commande</a></button>
			<?php endif ?>

		</form>

	</div>
</div>

<div id="ok"></div>


<?php /*unset($_SESSION['basket']['1']);*/ ?>
<?php/* print_r($_SESSION['basket'])*/ ?>
<?php $this->stop('main_content') ?>
