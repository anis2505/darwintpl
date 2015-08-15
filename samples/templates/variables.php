<!DOCTYPE html>
<html lang="en">
<head>
    <title>Darwin Templating System: Passing data to the template</title>
</head>

<body>
<h1>Variables: Passing data to template</h1><hr/>
<p>
    <h2>Hello <?= $name ?></h2>

    <h3>Your informations are:</h3>
    <ul>
        <li>Occupation: <?=$occupation?></li>
        <li>Nationality: <?=$nationality?></li>
        <li>Contact:
            <ul>
                <li>Phone: <?= $contact['phone'] ?></li>
                <li>Email: <?= $contact['email'] ?></li>
            </ul>
        </li>
    </ul>
</p>

<b>Sanitizing ouput</b><br/>
<?= $this->e($maliciousCode);?>

</body>

</html>