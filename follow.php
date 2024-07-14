<?php

/**
 * Follow user
 */

session_start();
require_once 'dbconnect.php';

use MongoDB\BSON\ObjectId; // Import the missing class

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$id = $_GET['id'];
$follower_id = $_SESSION['user']['_id'];

$collection = $db->followers;

$collection->insertOne([
    'user_id' => new ObjectId($id),
    'follower_id' => new ObjectId($follower_id)
]);

header('Location: user.php?id=' . $id);
