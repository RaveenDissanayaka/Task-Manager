<?php
// DB credentials.
define('DB_HOST', 'localhost'); // Host name
define('DB_USER', 'root'); // user name
define('DB_PASS', ''); // db user password
define('DB_NAME', 'task_manager'); // db name
// Establish database connection.
try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>