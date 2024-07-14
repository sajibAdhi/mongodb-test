<?php

/**
 * Home page
 */

session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$user = $_SESSION['user'];

$collection = $db->tweets;

$tweets = $collection->find([], [
    'sort' => ['created_at' => -1]
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

    <!-- Create Tweet -->
    <div class="flex justify-center mt-4">
        <div class="w-1/2">
            <form method="POST" action="create_tweet.php">
                <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                    <input name="tweet" type="text" placeholder="What's happening?" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
                    <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Tweet</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Twitter Tweers cards also  show creator -->
    <div class="flex justify-center mt-4">
        <div class="w-1/2">
            <?php foreach ($tweets as $tweet) : ?>
                <div class="bg-white p-4 rounded mt-4">
                    <p class="text-gray-500"><?php echo $tweet['created_at'] ?></p>
                    <p class="text-lg"><?php echo $tweet['tweet'] ?></p>
                    <!-- user link -->
                    <a href="user.php?id=<?php echo $tweet['author_id'] ?>" class="text-blue-500">
                        <?= $tweet['author_name'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once "layouts/footer.php" ?>
</body>

</html>