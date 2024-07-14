<?php

/**
 * Logout page
 */
session_start();
session_destroy();
header('Location: index.php');
