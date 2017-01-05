<?php $this->layout('layout', ['title' => 'Menu']) ?>

<?php $this->start('main_content') ?>
<?php /*session_unset(); session_destroy()*/ ?>

<input type="hidden" id="url_order" value="<?php echo $this->url('add_product_supplement') ?>">
<input type="hidden" id="url_delete" value="<?php echo $this->url('delete_product_supplement') ?>">
<input type="hidden" id="url_search" value="<?php echo $this->url('search_product') ?>">

<!-- Affichage des catégories -->
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<?php foreach ($allCategory as $category): ?>
			<li><a href="<?php echo $this->url('display_menu_category', ['id' => $category['id']]) ?>" title="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></a></li>
		<?php endforeach ?>
	</ul>

	<form class="navbar-form navbar-right center-block" name="search" method="POST">
        <div class="form-group" id="form-group">
        	<input type="text" id="search" class="form-control search" placeholder="Rechercher un produit">
        </div>
    </form>
</nav>

<!-- Affichage de la liste des produits en fonction de la categorie -->
<div class="col-md-8" id="menu">

	<?php foreach ($allMenu as $menu): ?>
		<div class="col-md-3">

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
		</div>
	<?php endforeach ?>
</div>

<!-- Affichage de la commande -->
<div class="col-md-4">
	<h2>Ma commande</h2>
	<div>
		<h1><?php echo $menu['name'] ?></h1>
		<img src="<?php echo $this->assetUrl('uploads/img/'.$menu['picture']) ?>" alt="<?php echo $menu['name'] ?>">
		<p><?php echo $menu['description'] ?></p>
		<p>Prix : <?php echo $menu['price'] ?> €</p>
		<button data-id="<?php echo $menu['id'] ?>">Ajouter au panier</button>
		<form action="<?php echo $this->url('add_order') ?>" id="command" method="POST" accept-charset="utf-8">
			<?php if (isset($_SESSION['basket'])): ?>
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
				<?php if (isset($_SESSION['user'])){ ?>
					<button type="submit" name="addOrder">Finaliser la commande</button>
				<?php } else { ?>
					<button><a href="<?php echo $this->url('user_login') ?>">Se connecter</a></button>
				<?php } ?>
			<?php endif ?>
		</form>
	</div>
</div>

<div id="ok"></div>

<?php $this->stop('main_content') ?>
