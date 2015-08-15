#DarwinTpl Template Engine V1.0.0
##Distribution repository

![GitHub Logo](/images/logo.png)

Php Template engine using native Php markup.
No complicated or new syntax to learn.

to get started. download the DarwinTpl package.

include the DarwinTpl class file.

	include(PATH_TO_DARWINTPL.'DarwinTpl.php')
	
Or simply using composer

	"require": {
	   "anis2505/darwintpl":"dev-master"
	}

in your composer.json file.

in you script create an instance of the class

	$darwinTpl = new DarwinTpl( ROOT_TEMPLATES_PATH );

Now you are ready to use DarwinTpl.

	$template->render("templatefile");

## Please consider checking the samples provided with this repository.
