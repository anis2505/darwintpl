

<?php

require_once 'common.php';


/**
 * Create DarwinTpl instance
 *
 */
$templatesDir = __DIR__.DS.'templates';
$template = new \src\DarwinTpl( $templatesDir );


/**
 * rendering template
 */
$template->render('basic');


//$assetsDir = __DIR__.DS.'assets';

//$baseURL = '//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

//$template->addPlugin( new \src\plugins\Asset( $assetsDir, $baseURL ) );



//$template->assign('name', 'Jhon Doe');

//$template->render('test');
