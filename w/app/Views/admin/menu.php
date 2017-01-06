<?php $this->layout('admin-layout', ['title' => 'Modification du menu']) ?>

<?php $this->start('main_content') ?>

	<input type="hidden" id="reorganise_categories_route" value="<?= $this->url('admin-menu_reorganise_categories') ?>">
	<input type="hidden" id="reorganise_products_route" value="<?= $this->url('admin-menu_reorganise_products') ?>">
	<input type="hidden" id="get_categories" value="<?= $this->url('get_categories') ?>">
	<input type="hidden" id="delete_category" value="<?= $this->url('admin-menu_delete_category') ?>">
	<input type="hidden" id="get_ingredients_ajax" value="<?= $this->url('admin-menu_get_ingredients_ajax') ?>">
	<input type="hidden" id="get_products_by_idCat_ajax" value="<?= $this->url('admin-menu_get_products_by_idCat_ajax') ?>">
	<input type="hidden" id="get_infos_by_idProd_ajax" value="<?= $this->url('admin-menu_get_infos_by_idProd_ajax') ?>">
	<input type="hidden" id="get_img_route" value="<?= $this->assetUrl('uploads/img/productPictures/mini/')?>">
	<input type="hidden" id="add_product" value="<?= $this->url('admin-menu_add_product') ?>">
	<input type="hidden" id="delete_product" value="<?= $this->url('admin-menu_delete_product') ?>">
	<input type="hidden" id="update_product" value="<?= $this->url('admin-menu_update_product') ?>">
	<input type="hidden" id="sleep_product" value="<?= $this->url('admin-menu_sleep_product') ?>">
	<input type="hidden" id="get_products_by_visibility_ajax" value="<?= $this->url('admin-menu_get_products_by_visibility_ajax') ?>">
	<input type="hidden" id="visibility_product" value="<?= $this->url('admin-menu_visibility_product') ?>">
	<input type="hidden" id="get_products_non_classes_ajax" value="<?= $this->url('admin-menu_non_classes_product') ?>">
	<input type="hidden" id="delete_products_non_classe" value="<?= $this->url('admin-menu_delete_product_non_classe') ?>">
	<input type="hidden" id="delete_products_no_visible" value="<?= $this->url('admin-menu_delete_product_no_visible') ?>">
	

		<div class="row page offset">
			
			<!-- Div délimitation avec menu à gauche à partir de md -->	
			<div class="col-xs-12 col-md-12">
				
				<!-- Début de la div catégories -->
				<div class="row" id="content_categories">
					<div class="col-xs-12 col-md-12 categoriesList">
						
						<h2>Vos catégories</h2>
 
						<div data-toggle="modal" data-backdrop="false" data-target="#formulaire" class="addCategoryIcon center-block" id="addCategoryIcon"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Ajouter une catégorie</div>
  						<div class="panel panel-default">
	  						<ul id="list-categories">
	  							<!-- Contenu de la liste ici -->
	  						</ul>
  						</div>
						
  						<h2>Produits non classés</h2>

  						<div class="panel panel-default">
	  						<ul id="list-nonClasses">
	  							<!-- Contenu de la liste ici -->
	  						</ul>
  						</div>

  						<h2>Produits desactivés</h2>

  						<div class="panel panel-default">
	  						<ul id="list-noVisible">
	  							<!-- Contenu de la liste ici -->
	  						</ul>
  						</div>

  						<h2>Produits à la une</h2>

  						<div class="panel panel-default">
	  						<ul id="list-highlights">
	  							<!-- Contenu de la liste ici -->
	  						</ul>
  						</div>




						<!-- Fenêtres modales -->

  						<!-- Fenêtre modale ajout catégorie-->
						<div class="modal fade" id="formulaire">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Ajouter une catégorie :</h4>
									</div>
									<div class="modal-body">
										<form action="<?= $this->url('admin-menu_add_category') ?>" method="POST">
											<div class="form-group">
												<input type="text" class="form-control" name ="newCategory" id="newCategory" placeholder="Votre nouvelle catégorie">
											</div>
											<button type="submit" class="btn btn-success">Créer</button>
										</form>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale ajout de catégorie-->
	
						<!-- Fenêtre modale suppression de catégorie -->
						<div class="modal fade" id="deleteCat">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Supprimer une catégorie :</h4>
									</div>
									<div class="modal-body">
										<p>
											Etes-vous sûr de vouloir supprimer cette catégorie?<br>
											Vous trouverez les produits qu'elle contient dans la catégorie "non classé";
										</p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
										<button type="button" id="deleteCatButton" class="btn btn-danger" data-dismiss="modal">Supprimer</button>
									</div>

								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale suppression de catégorie -->

						<!-- Fenêtre modale modification de catégorie-->
						<div class="modal fade" id="updateCat">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Modifier la catégorie :</h4>
									</div>
									<div class="modal-body">
										<form id="updateCat" action="<?= $this->url('admin-menu_update_category') ?>" method="POST">
											<div class="form-group">
												<input type="text" class="form-control" name ="updateCategory" id="updateCategory" placeholder="">
											</div>
											<button type="submit" class="btn btn-success">Modifier</button>
										</form>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale modification de catégorie -->

				
						<!-- Fenêtre modale ajout de produit-->
						<div class="modal fade" id="addProd">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Ajouter un produit :</h4>
									</div>
									<div class="modal-body">

										<div class="row">
											<div class="col-xs-12">

																		
												<form id="addProdForm" class="form-horizontal well" method="post" action="<?= $this->url('admin-menu_add_product') ?>" enctype="multipart/form-data">
												
													<fieldset>
														
														<div class="form-group">
															<input type="hidden" id="idCategoryHidden" name="idCategoryHidden" value="">
															<input type="hidden" id="tokenfieldValues" name="tokenfieldValues" value="">
														</div>

														<div class="form-group">
															<label for="productPicture" class="col-lg-2 control-label">Image du produit</label>
															<div class="col-lg-10">
																<input type="file" class="form-control" id="productPicture" name="productPicture" accept="image/*">
															</div>
														</div>

														<div class="form-group" style="margin-bottom: 0;">
															<div id="image_preview" class="col-lg-10 col-lg-offset-2">
																<div class="thumbnail hidden">
																	<img src="" alt="">
																	<div class="caption">
																		<h4 id="fileName"></h4>
																		<p></p>
																		<p><button type="button" class="btn btn-default btn-danger">Annuler</button></p>
																	</div>
																</div>
															</div>
														</div>
														<!-- Message d'erreur -->
														<div class="alert alert-danger hide error fileWeightMax" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L'image doit peser moins de 2Mo <br>
														</div>
														<div class="alert alert-danger hide error fileEmpty" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Veuillez choisir une image <br>
														</div>
														<div class="alert alert-danger hide error fileType" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Fichiers acceptés : .jpg / .bmp / .gif / .png <br>
														</div>
														<div class="alert alert-danger hide error fileSizeMin" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L\'image doit mesurer plus de 200px de largeur et 200px de heuteur <br>
														</div>
														<div class="alert alert-danger hide error fileSizeMax" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L'image doit mesurer moins de 800px de largeur et 800px de hauteur <br>
														</div>
														<div class="alert alert-danger hide error fileLoad" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Problème lors du chargement de l'image <br>
														</div>


														<div class="form-group">
															<label for="productName" class="col-lg-2 control-label">Nom du produit</label>
															<div class="col-lg-10">
																<input type="text" class="form-control" id="productName" name="productName" placeholder="Nom du produit">
															</div>
														</div>
														<!-- Message d'erreur -->
														<div class="alert alert-danger hide error productNameLength" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Votre nom de produit doit contenir entre 2 et 50 caractères<br>
														</div>


														<div class="form-group">
															<label for="productDescription" class="col-lg-2 control-label">Description</label>
															<div class="col-lg-10">
																<textarea class="form-control" rows="3" id="productDescription" name="productDescription" placeholder="Description du produit"></textarea>
															</div>
														</div>
														<!-- Message d'erreur -->
														<div class="alert alert-danger hide error productDescriptionLength" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Le description du produit doit contenir entre 10 et 500 caractères<br>
														</div>


														<div class="form-group">
															<label for="productIngredients" class="col-lg-2 control-label">Ingrédients</label>
															<div class="col-lg-10">
																<input type="text" class="form-control" id="productIngredients" name="productIngredients" placeholder="Ingrédients">
															</div>
														</div>
														<!-- Message d'erreur -->
														<div class="alert alert-danger hide error ingredientsListEmpty" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Veuillez enregistrer au moins un ingrédient<br>
														</div>
														<div class="alert alert-danger hide error ingredientType" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Vous avez saisi un nom d'ingrédient non valide<br>
														</div>


														<div class="form-group">
															<label for="productPrice" class="col-lg-2 control-label">Prix</label>
															<div class="col-lg-10">
																<input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Prix du produit">
															</div>
														</div>
														<!-- Message d'erreur -->
														<div class="alert alert-danger hide error productPriceType" role="alert">
															<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Votre prix doit être un nombre entier ou à virgule<br>
														</div>


														<input type="hidden" name="send-file"/>

														<div class="form-group">
															<div class="col-lg-10 col-lg-offset-2">
																<button name="sendProductForm" id="sendProductForm" class="btn btn-primary">Envoyer</button>
															</div>
														</div>

													</fieldset>

												</form>

											</div>
										</div>

									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale ajout de produit-->

						<!-- Fenêtre modale suppression de produit -->
						<div class="modal fade" id="deleteProd">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Supprimer un produit :</h4>
									</div>
									<div class="modal-body">
										<p>
											Etes-vous sûr de vouloir supprimer ce produit?<br>
										</p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
										<button type="button" id="deleteProdButton" class="btn btn-danger" data-dismiss="modal">Supprimer</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale suppression de produit -->

						<!-- Fenêtre modale modification de produit-->
						<div class="modal fade" id="updateProd">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Modifier le produit :</h4>
									</div>
									<div class="modal-body prodInfos">
										<!-- <form id="updateProd" action="#<?= $this->url('admin-menu_update_product') ?>" method="POST">
											<div class="form-group">
												<input type="text" class="form-control" name ="updateProductName" id="updateProductName" placeholder="Nom du produit">
											</div>
											<button type="submit" class="btn btn-success">Enregistrer les modifications</button>
										</form> -->
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale modification de produit -->

						<!-- Fenêtre modale mise en no visibility produit -->
						<div class="modal fade" id="sleepProd">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Désactiver un produit :</h4>
									</div>
									<div class="modal-body">
										<p>
											Etes-vous sûr de vouloir désactiver ce produit?<br>
											Vous pourrez à tout moment rendre ce produit à nouveau visible par vos visiteurs, en vous rendant dans la catégorie "Produits désactivés", et en cliquant sur le bouton de réactivation.
										</p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
										<button type="button" id="sleepProductButton" class="btn btn-danger" data-dismiss="modal">Désactiver</button>
									</div>

								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale mise en no visibility produit -->

						<!-- Fenêtre modale mise en no visibility produit -->
						<div class="modal fade" id="activateProd">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Réactiver un produit :</h4>
									</div>
									<div class="modal-body">
										<p>
											Etes-vous sûr de vouloir réactiver ce produit?<br>
											Vous pourrez à nouveau le désactiver en cliquant sur le bouton pause.
										</p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-primary" data-dismiss="modal">Annuler</button>
										<button type="button" id="activateProductButton" class="btn btn-success" data-dismiss="modal">Réactiver</button>
									</div>

								</div>
							</div>
						</div>
						<!-- Fin de la fenêtre modale mise en no visibility produit -->
						
						<!-- Fin des fenêtres modales -->
				
					</div>
				</div>
				<!-- Fin de la div catégories -->

			</div>
			<!-- Fin div délimitation avec menu à gauche à partir de md -->	
		</div>
		<!-- Fin de la div row -->

				

<?php $this->stop('main_content') ?>


<?php $this->start('admin_script') ?>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<!-- Fichier Script Tokens JS -->
<script src="<?= $this->assetUrl('dist/bootstrap-tokenfield.min.js') ?>"></script>
<!-- Fichier Script JS -->
<script src="<?= $this->assetUrl('js/script.js') ?>"></script>

<?php $this->stop('admin_script') ?>