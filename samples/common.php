
<?php

/**
 *	Error reporting
 *	Please remove it when production
 *
 */
/**
 *	Error reporting
 */
define('ENVIRONMENT', 'development');
if (defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}

define('DS', DIRECTORY_SEPARATOR);

require_once __DIR__.DS.'..'.DS.'src'.DS.'Partials.php';

require_once __DIR__.DS.'..'.DS.'src'.DS.'DarwinTpl.php';

require_once __DIR__.DS.'..'.DS.'src'.DS.'PluginInterface.php';

require_once __DIR__.DS.'..'.DS.'src'.DS.'Plugins'.DS.'Asset.php';


