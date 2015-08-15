
<!-- First we need to set the template's main layout -->
<?php $this->setlayout('layouts/layout') ?>



<!-- We start a block by calling the startblock method with the block name as parameters -->
<?php $this->startblock('contents') ?>

    <h4>Contents block</h4>

    Hello this is sample3 contents

<!-- we end the block by calling the endblock method -->
<?php $this->endblock(); ?>


<!-- Blocks can be nested -->
<?php $this->startblock('anotherblock') ?>

    <h4>Another block</h4>

    This block will contain a subblock

    <!-- This is an inner block -->
    <?php $this->startblock('subblock') ?>

        <h4>Sub block</h4>
        This is a sub block

    <?php $this->endblock() ?>

<?php $this->endblock() ?>

<!-- When using layouts if a block is not called in the layout. it won't be shnow -->
<?php $this->startblock('onotherblock') ?>

This block won't be shown.
because it's doesn't appear on the main layout.

<?php $this->endblock() ?>