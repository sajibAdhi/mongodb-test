<?php

/**
 * Users page
 */

session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$collection = $db->users;

$users = $collection->find();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Twitter</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once "layouts/header.php" ?>

    <!-- Users -->
    <div class="flex justify-center mt-4">
        <div class="w-1/2">
            <?php foreach ($users as $user) : ?>
                <div class="bg-white p-4 rounded mt-4">
                    <h1 class="text-2xl font-bold"><?php echo $user['username'] ?></h1>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once "layouts/footer.php" ?>
</body>