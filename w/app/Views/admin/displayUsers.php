<?php foreach ($allUsers as $user): ?>
    <div>
        <h3><?= $user['username'] ?></h3>
        <p>Prénom : <?= $user['firstname'] ?></p>
        <p>Nom :  <?= $user['lastname'] ?> </p>
        <p>Role :  <?= $user['role'] ?> </p>
    </div>

    <!-- Bouton permettan l'affichage de la modal de modification des rôles -->
    <button type="button" class="btn btn-info btnModalUsers" data-toggle="modal" data-target="#myModal-<?php echo $user['id'] ?>" name="<?= $user['id'] ?>">Modifier</button>

    <!-- Boite de dialogue avec le formulaire de modification -->
    <!-- Modal -->
    <div class="modal fade" id="myModal-<?php echo $user['id'] ?>" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= $user['username'] ?></h4>
                </div>
                <div class="modal-body">
                    <!-- formulaire affichant le menu de modification des roles ou de suppression d'un utilisateur sélectionner puis les select pour les supplements -->
                    <form action="#" method="POST" accept-charset="utf-8">
                        Role :
                        <select name="role" id="idRole<?= $user['id'] ?>">
                                <option value="admin">Admin</option>
                            <option value="user">Utilisateur</option>
                        </select><br>
                        <input type="submit" name="updateUser" class="updateUser btn btn-default" data-dismiss="modal" data-id="<?= $user['id'] ?>" value="Valider">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
            </div>

        </div>
    </div>
<?php endforeach ?>
