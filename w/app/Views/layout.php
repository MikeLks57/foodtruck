<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title></title>

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<script
  src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
  integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
  crossorigin="anonymous"></script>
	<script src="<?= $this->assetUrl('js/script.js') ?>"></script>
</head>
<body>
	<div class="container">
		<header>
			
		</header>

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>

<?= $this->section('scripts') ?>
</body>
</html>