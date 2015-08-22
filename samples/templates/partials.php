<html>
<head>
	<title>Darwin Templating System: Parials sample</title>
</head>

<h1> Partials sample </h1>

sample partial form


<p>
<h3>Remember:</h3>
Unlike blocks and inserts: Partials can't automatically access the template data.<br/>
So if you need to pass data to it. you should provide it when rendering the partial just like the following code.
</p>

<?= $this->partial( 'form', array( 'action' => $_SERVER['PHP_SELF'], 'method' => 'post' ) ) ?>



</html>