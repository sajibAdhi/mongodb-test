<?php

/**
 * Register page
 */

session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['user'])) {
    header('Location: home.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection = $db->users;
    $username = $_POST['username'];
    $password = $_POST['password'];

    // input validation
    if (empty($username) || empty($password)) {
        echo 'Username and password are required';
        return;
    }

    // check if username already exists
    $user = $collection->findOne(['username' => $username]);
    if ($user) {
        echo 'Username already exists';
    } else {
        // insert user into database
        $insertOneResult = $collection->insertOne([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // check if user was inserted successfully
        if ($insertOneResult->getInsertedCount() == 1) {
            echo 'User registered successfully';
        } else {
            echo 'Error registering user';
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Twitter Clone</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
    <!-- Twitter Register Page with Login Link -->
    <div class="flex justify-center items-center h-screen">
        <div class="w-1/3">
            <h1 class="text-2xl font-bold mb-4">Register</h1>
            <form method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
            </form>
            <p class="mt-4">Already have an account? <a href="index.php" class="text-blue-500">Login</a></p>
        </div>
    </div>
</body>