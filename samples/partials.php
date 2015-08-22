

<?php

require_once 'common.php';


$templatesDir = __DIR__.DS.'templates';

/**
* The parials directory.
*/
$partialsDir = $templatesDir.DS.'partials';


/**
 * Create DarwinTpl instance
 *
 */
$template = new \DarwinTpl( $templatesDir, $partialsDir );


$data = array(
    'occupation'    => 'Web developer',
    'nationality'   => 'Earthian',
    'contact'       => array('phone'=>'777555777', 'email' => 'myemail@domain.com' )
);




$template->render('partials', $data);//, $data);
