<?php $this->setlayout('layouts/layout')?>

<?php $this->startblock('contents')?>

<h1> Hello <?= $name; ?> </h1>

<?= $this->getFile('test'); ?>

<?= $this->show('The News'); ?>

<?php $this->endblock()?>