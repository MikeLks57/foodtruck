<?php $this->layout('layout', ['title' => 'Modification du menu']) ?>

<?php $this->start('main_content') ?>
	<main>
        <section class="main-section">
        	<div class="container-fluid">
        		<div class="row productsDisplay">
  					<div class="col-xs-12 col-md-10 col-md-offset-2">
	  					<div class="row" id="content_prod">
	 						<?php foreach($allProducts as $product) : ?>
	 							<div class="col-xs-4 col-md-3">
	 								<img src="<?= $this->assetUrl('img/'. $product['productPicture']) ?>" width="200px" height="150px">
	 							</div>
	 						<?php endforeach ; ?>
	  					</div>
  					</div>
				</div>
	        </div><!-- div class="container-fluid" -->
	    </section><!-- main-section -->
	</main>

	
	
	

<?php $this->stop('main_content') ?>