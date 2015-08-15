

<?php


/**
 * A plugin is a simple class that implements the PluginInterface.
 *
 * So the class must provide an implementation to the PluginInterface init method
 *
 * Example from the Asset plugin
 *  public function init(&$template)
{
$template->register('asset', $this, 'asset');
$template->register('css', $this, 'css');
$template->register('js', $this, 'js');
}
 *
 *
 *
 *
 */



require_once 'common.php';


/**
 * Create DarwinTpl instance
 *
 */
$templatesDir = __DIR__.DS.'templates';
$template = new \Darwin\DarwinTpl( $templatesDir );



$assetsDir = __DIR__.DS.'assets';


$baseURL = '//localhost/anis/darwintpl/samples';


/**
 * Adding the asset plugin to DarwinTpl's instance.
 */
$template->addPlugin( new \src\plugins\Asset( $assetsDir, $baseURL ) );

/**
 * rendering template
 */
$template->render('plugins');

$parts = parse_url( $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], PHP_URL_HOST );
print_r($parts);
