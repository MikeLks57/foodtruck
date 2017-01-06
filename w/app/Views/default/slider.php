<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<!-- carrousel bootstrap en js -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $i=0; foreach ($allSlider as $slider):  ?>
        <li data-target="#carousel-example-generic" data-slide-to="0" <?php if($i === 0) echo 'class="active"' ?>></li>
        <?php $i++; endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i=0; foreach ($allSlider as $slider): ?>
        <!-- Boucle pour passer la class active uniquement à l'image 0 -->
        <div class="item<?php if($i === 0) echo ' active' ?>">
            <img src="<?php echo $this->assetUrl('uploads/img/'.$slider['url']) ?>" alt="<?php echo $slider['name'] ?>">
            <img src="<?= $this->assetUrl('uploads/img/').  $slider['url'] ?>" alt="<?= $slider['title'] ?>">
            <div class="carousel-caption">
                <h3><?= $slider['title'] ?></h3>
                <p><?= $slider['description'] ?></p>
            </div>
        </div>
        <!-- Incrémentation des images à chaque boucle pour changer d'image -->
        <?php $i++; endforeach; ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Fin du caroussel -->
<?php $this->stop('main_content') ?>