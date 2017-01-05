<?php $this->layout('admin-layout', ['title' => 'Gérer le slider']) ?>

<?php $this->start('main_content') ?>
    <input type="hidden" id="addSliderPicsRoute" value="<?= $this->url('admin_slider_add') ?>" />
    <input type="hidden" id="deleteSliderPicsRoute" value="<?= $this->url("admin_slider_delete") ?>" />
    <input type="hidden" id="showSliderPicsRoute" value="<?= $this->url('admin_slider_pics') ?>" />
    <input type="hidden" id="countSliderPicsRoute" value="<?= $this->url('admin_slider_count') ?>" />

    <div class="row">
        <div class="col col-sm-12 ">
            <div class="row showImg">
            <!-- Zone d'affichage des images ajoutées en BDD -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col col-sm-12">
            <div class="alert alert-danger hide error title-empty" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Veuillez remplir le champ titre <br>
            </div>
            <div class="alert alert-danger hide error description-empty" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Veuillez remplir le champ description <br>
            </div>
            <div class="alert alert-danger hide error file-empty" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Veuillez choisir une image <br>
            </div>
            <div class="alert alert-danger hide error file-type" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Fichiers acceptés : .jpg / .bmp / .gif & .png <br>
            </div>
            <div class="alert alert-danger hide error file-sizeMin" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L\'image doit mesurer plus de 350px de hauteur et 750px de largeur <br>
            </div>
            <div class="alert alert-danger hide error file-sizeMax" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L\'image doit mesurer moins de 800px de hauteur et 1500px de largeur <br>
            </div>
            <div class="alert alert-danger hide error title-weightMin" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L\'image doit peser moins de 2mo <br>
            </div>
            <div class="alert alert-danger hide error file-weightMax" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> L\'image doit peser moins de 2mo <br>
            </div>
            <div class="alert alert-danger hide error file-load" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Problème lors du chargement de l\'image <br>
            </div>
            <div class="alert alert-danger hide error nbPicsFull" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Vous ne pouvez pas ajouter plus de 4 images à votre slider <br>
            </div>
        </div><!-- <div class="col col-sm-12 hidden showErrors"> -->
    </div><!-- class="row" -->

    <h1>Ajoutez des photos à votre Slider d'accueil :</h1>
    <form enctype="multipart/form-data" id="sliderForm" method="POST" accept-charset="utf-8">

        <div class="input-group">
            <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
            <input type="text" name="title" class="form-control" placeholder="Titre de votre photo" aria-describedby="sizing-addon1">
        </div>

        <div class="input-group">
            <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-menu-right"></span></span>
            <input type="text" name="description" class="form-control" placeholder="Description de votre photo" aria-describedby="sizing-addon1">
        </div>

        <section class="errors">

        </section>

        <h3><span class=" label label-default">Sélectionner votre image :</span></h3>
        <label id="btnBrowse" class="btn btn-default">
            Parcourir <span class="glyphicon glyphicon-plus"></span> <input name="my-file" type="file" id="file">
        </label>

        <input type="hidden" name="send-file"/>
        <input type="submit" class="btn btn-primary" id="submit-file" value="Ajouter" />
    </form>

<?php $this->stop('main_content') ?>

<?php $this->start('admin_script') ?>
<script src="<?= $this->assetUrl('js/admin_slider_script.js') ?>"></script>
<?php $this->stop('admin_script') ?>
