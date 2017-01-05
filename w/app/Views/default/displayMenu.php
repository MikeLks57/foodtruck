<div class="col-md-9" id="menu">

	<?php foreach ($allMenu as $menu): ?>
		<div class="col-md-3 text-center ">
			<div class="well">

				<h1><?php echo $menu['name'] ?></h1>
				
				<img src="<?php echo $this->assetUrl('uploads/img/'.$menu['picture']) ?>" alt="<?php echo $menu['name'] ?>" class="img-rounded img-responsive">

				<p><?php echo $menu['description'] ?></p>
				<p>Prix : <?php echo $menu['price'] ?> €</p>

				<!-- Boutton ouvrant la boite de dialogue avec le formulaire des supplements -->
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-<?php echo $menu['id'] ?>" name="<?php echo $menu['id'] ?>">Ajouter au panier</button>

			</div>
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
					    			<select class="supplement" name="supplement[]">

					    				Supplément <?php echo $i ?> : 
					    				<option value="0" selected>Sélectioner</option>
					    				<?php foreach ($allSupplement as $supplements): ?>

											<option value="<?php echo $supplements['name'] ?>" data-price="<?= $supplements['price'] ?>">

						    					<?php echo $supplements['name'].' '.$supplements['price'].'€' ?>
						    					
											</option>
											
										<?php endforeach ?>
									</select><br>
					    		<?php } ?>
					    		<input type="hidden" name="supplement-price" id="supplement-price" value="0">
					    		<input type="hidden" name="price" value="<?php echo $menu['price'] ?>">
				    			<input type="hidden" name="nameProduct" value="<?php echo $menu['name'] ?>">
				    			<input type="submit" name="order" class="order btn btn-default" data-dismiss="modal" value="Ajouter à la commander">
				    			<div class="modal-footer">
			    					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			    				</div>
				    		</form>
			    		</div>
			    		
			    	</div>

		    	</div>
			</div>
		</div>
	<?php endforeach ?>
</div>