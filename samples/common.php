
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


function __autoload($class_name)
{
    include __DIR__.DS.'..'.DS. str_replace('\\', DS, $class_name).'.php';
}

