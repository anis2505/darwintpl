

<?php

require_once 'common.php';


/**
 * Create DarwinTpl instance
 *
 */
$templatesDir = __DIR__.DS.'templates';
$template = new \src\DarwinTpl( $templatesDir );


/*
 * When using main layout it's necessary to specify blocks.
 * for every block of data.
 *
 * Blocks can be nested and can be overrided.
 *
 * Please take a look to the layout file and template file
*/


$template->render('layouts');
