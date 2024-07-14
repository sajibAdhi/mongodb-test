<?php

/**
 * User page
 */


session_start();
require_once 'dbconnect.php';

use MongoDB\BSON\ObjectId; // Import the missing class


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
// get id from URL and then get its tweets
$id = $_GET['id'];
$follower_id = $_SESSION['user']['_id'];

$collection = $db->tweets;

$user = $db->users->findOne([
    '_id' => new ObjectId($id) // Use the imported class
]);
$tweets = $collection->find([
    'author_id' => new ObjectId($id) // Use the imported class
], [
    'sort' => ['created_at' => -1]
]);

$follower = $db->followers->find([
    'user_id' => new ObjectId($id), // Use the imported class
    'follower_id' => new ObjectId($follower_id) // Use the imported class
]);

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

    <!-- Twitter profile ui with follow link -->
    <div class="flex justify-center mt-4">
        <div class="w-1/2">
            <div class="bg-white p-4 rounded">
                <h1 class="text-2xl font-bold"><?php echo $user['username'] ?></h1>
                <!-- if followed then unfollow link -->
                <?php if (count(iterator_to_array($follower)) > 0) : ?>
                    <a href="unfollow.php?id=<?php echo $id ?>" class="text-blue-500">Unfollow</a>
                <?php else : ?>
                    <a href="follow.php?id=<?php echo $id ?>" class="text-blue-500">Follow</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tweets -->
    <div class="flex justify-center mt-4">
        <div class="w-1/2">
            <?php foreach ($tweets as $tweet) : ?>
                <div class="bg-white p-4 rounded mt-4">
                    <p class="text-gray-500"><?php echo $tweet['created_at'] ?></p>
                    <p class="text-lg"><?php echo $tweet['tweet'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once "layouts/footer.php" ?>
</body>