<?php $this->layout('layout', ['titre'=>'A propos'])  ?>

<?php $this->start('main_content'); ?>

<?= $about; ?>

<?php $this->stop('main_content');  ?>