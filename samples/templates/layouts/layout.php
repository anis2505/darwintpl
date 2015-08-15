<!DOCTYPE html>
<html lang="en">
<head>
    <title>Darwin Templating System: Layouts & Blocks</title>
</head>

<body>
<h1>The Main layout page</h1>

<?php $this->startblock('topblock')?>
<h4>Top Block</h4>
<p>
if the template does not provide data for the top block.
this will be shown instead.
</p>
<?php $this->endblock() ?>

<?php $this->startblock('contents') ?>

<?php $this->endblock() ?>

<?php $this->startblock('anotherblock') ?>

<?php $this->endblock(); ?>

</body>

</html>