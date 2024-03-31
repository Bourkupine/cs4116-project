<?php
require '../config.php';

/**
 * Attempts to connect to the database
 * @return string Returns if the connection was successful
 */
function connect(): string {
    if (isset($_CONFIG)) {
        $servername = $_CONFIG['servername'];
        $username = $_CONFIG['username'];
        $password = $_CONFIG['password'];
        $database = $_CONFIG['database'];

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return "<script> console.log(\"Connected to $database successfully\");</script>";
    }
    return "<script> console.log(\"Connection failed: missing DB configurations\");</script>";
}