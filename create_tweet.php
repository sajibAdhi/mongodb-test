<?php

/**
 * Create tweet
 */

session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection = $db->tweets;

    // Validate tweet
    if (!isset($_POST['tweet']) || empty($_POST['tweet'])) {
        echo 'Invalid tweet';
        exit;
    }

    $tweet = substr($_POST['tweet'], 0, 140);
    $date = date('Y-m-d H:i:s');


    $collection->insertOne([
        'author_id' => $user['_id'],
        'author_name' => $user['username'],
        'tweet' => $tweet,
        'created_at' => $date
    ]);

    header('Location: home.php');
} else {
    echo 'Invalid tweet';
}
