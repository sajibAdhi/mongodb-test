<?php
require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->test->friends;

$result = $collection->find();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Friends</title>
</head>

<body>
    <h1>Friends</h1>
    <table border="1">
        <thead>
            <th>Name</th>
            <th>Age</th>
            <th>City</th>
        </thead>
        <tbody>
            <?php foreach ($result as  $entry) : ?>
                <tr>
                    <td><?php echo $entry['name']; ?></td>
                    <td><?php echo $entry['age']; ?></td>
                    <td><?php echo $entry['city']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</body>

</html>