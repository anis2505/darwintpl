

<?php

require_once 'common.php';


/**
 * Create DarwinTpl instance
 *
 */
$templatesDir = __DIR__.DS.'templates';
$template = new \Darwin\DarwinTpl( $templatesDir );


/**
 * To add a variable you can simply use the assign mthod as follows.
 */
$template->assign('name', 'Jhon Doe');

$data = array(
    'occupation'    => 'Web developer',
    'nationality'   => 'Earthian',
    'contact'       => array('phone'=>'777555777', 'email' => 'myemail@domain.com' )
);


/*
 We can use the assign method as follows

$thi->template->assign('data, $data'); //the data will stored in an array $data.

or Simple pass the data to the template when rendered.
*/



$maliciousCode = "<script type='text/javascript'>alert('Hacked');</script>";

$template->assign('maliciousCode', $maliciousCode);

$template->render('variables', $data);
