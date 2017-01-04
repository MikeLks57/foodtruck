<?php $this->layout('admin-layout', ['title' => 'Gestion utilisateur']) ?>

<?php $this->start('main_content') ?>

    <input type="hidden" id="url_search_user" value="<?php echo $this->url('admin_search_user') ?>">
    <input type="hidden" id="updateRole" value="<?= $this->url('admin_update_role') ?>">

    <h2>Gérer le rôle de vos utilisateurs</h2>

    <form class="navbar-form center-block" name="search" method="POST">
        <div class="form-group" id="form-group">
            <input type="text" id="searchUser" class="form-control search" placeholder="Trouver un utilisateur">
        </div>
    </form>

<div class="row">
    <div class="col col-sm-12">
        <div class="alert alert-danger hide error update" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Erreur lors de la modification <br>
        </div>
        <div class="alert alert-success hide success update" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> L'utilisateur a bien été modifié <br>
        </div>
    </div><!-- <div class="col col-sm-12"> -->
</div><!-- class="row" -->
    <div class="row">
        <div class="col-xs-12 col-md-5" id="usersFind">
            <!-- Zone d'affichage des utilisateurs trouvés par la recherche admin -->
        </div>
    </div>


<?php $this->stop('main_content') ?>

<?php $this->start('admin_script') ?>
    <script src="<?= $this->assetUrl('js/admin_user_script.js') ?>"></script>
<?php $this->stop('admin_script') ?>
