<?php

/**
 * Attempts to connect to the database and returns the connection
 * @return mysqli the connection
 * @throws Exception if _CONFIG is not set
 */
function connect(): mysqli
{
    require "../config.php";
    if (isset($_CONFIG)) {
        $servername = $_CONFIG["servername"];
        $username = $_CONFIG["username"];
        $password = $_CONFIG["password"];
        $database = $_CONFIG["database"];

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }
    throw new Exception("Connection failed: Missing configurations");
}

/**
 * Disconnects the passed connection if it is connected to a database
 * @param mysqli $connection the connection to be disconnected
 * @return void
 */
function disconnect(mysqli $connection): void
{
    if ($connection->ping()) {
        $connection->close();
    }
}