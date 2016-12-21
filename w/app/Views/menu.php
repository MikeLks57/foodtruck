<?php $this->layout('layout', ['title' => 'Menu']) ?>

<?php $this->start('main_content') ?>

<nav>
	<ul>
		<?php foreach ($allCategory as $category): ?>
			<li><a href="<?php echo $this->url('display_menu_category', ['id' => $category['id']]) ?>" title="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></a></li>
		<?php endforeach ?>
	</ul>
</nav>

<?php foreach ($allMenu as $menu): ?>
	<div>
		<h1><?php echo $menu['name'] ?></h1>
		<img src="<?php echo $this->assetUrl('img/'.$menu['picture']) ?>" alt="<?php echo $menu['name'] ?>">
		<p><?php echo $menu['description'] ?></p>
		<p>Prix : <?php echo $menu['price'] ?> €</p>
		<button data-id="<?php echo $menu['id'] ?>">Ajouter au panier</button>	
	</div>
<?php endforeach ?>

<?php $this->stop('main_content') ?>
