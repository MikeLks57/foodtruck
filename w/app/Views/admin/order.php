<?php $this->layout('admin-layout', ['title' => 'Bienvenue dans votre panneau de configuration']) ?>

<?php $this->start('main_content') ?>
<input type="hidden" id="sendSms" value="<?= $this->url('admin_send_message') ?>">
<input type="hidden" id="stopCommand" value="<?= $this->url('admin_delete_order') ?>">
<h1 class="text-center">Liste des commandes en cours</h1>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Produit</th>
				<th>Total</th>
				<th>Etat</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($allOrder): ?>
			
		
		<?php foreach ($allOrder as $key => $order): ?>

				<tr>
					<form action="<?php $this->url('admin_order') ?>" method="" class="start" accept-charset="utf-8">
						<!-- Va chercher les données utilisateur --> 
						<?php foreach ($order['users'] as $users): ?>
							<td><?php echo $users['lastname'] ?></td>
							<td><?php echo $users['firstname'] ?></td>
							<td>
								<!-- Va chercher les données produits --> 
								<?php foreach ($order['product'] as $product): ?>
									<table class="table table-bordered">
									<tr>
										<th><?php echo $product['prod'] ?></th>
									</tr>
									<?php if (isset($product['ing'])): ?>
										<!-- Va chercher les données ingrédients --> 
										<?php foreach ($product['ing'] as $ingredient): ?>
											<tr>
												<td><?php echo $ingredient['ingredient'] ?></td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
									

									</table>
								<?php endforeach ?>
								
							</td>
							<td><?php echo $users['total'] ?></td>
							    
							<td>
								<!-- Boutton envois de sms signalant le début de la préparation de la commande -->
								<input type="submit" class="btn btn-infos sendSms" data-orderId="<?= $users['id'] ?>" value="Preparer la commande" />
								<!-- boutton suppression en base de données -->
								<input type="submit" class="stopCommand btn btn-infos hide " data-orderId="<?= $users['id'] ?>" value="Terminée !" />
							</td>
					<?php endforeach ?>

					</form>
				</tr>

		<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>	
</div>




<?php $this->stop('main_content') ?>
<?php $this->start('admin_script') ?>
    <script src="<?= $this->assetUrl('js/admin_order_script.js') ?>"></script>
<?php $this->stop('admin_script') ?>