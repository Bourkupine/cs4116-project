<?php

require 'database-connect.php';
require '../models/user.php';

function create_user_user(string $email, string $password): bool {
    connect();
    global $connection;

    $sql = "INSERT INTO users (email, password, account_type)
VALUES ($email, $password, 'user')";

    if ($connection->query($sql) === TRUE) {
        disconnect();
        return true;
    } else {
        disconnect();
        return false;
    }
}

function get_user_by_id(int $user_id): models\user {
    connect();
    global $connection;

    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return new \models\user($result['user_id'], $result['email'], $result['password'], $result['account_type']);
    } else {
        throw new mysqli_sql_exception();
    }
}

function get_user_by_email(string $email): models\user {
    connect();
    global $connection;

    $sql = "SELECT * FROM users WHERE email=$email";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return new \models\user($result['user_id'], $result['email'], $result['password'], $result['account_type']);
    } else {
        throw new mysqli_sql_exception();
    }
}

function delete_user_by_user_id(int $user_id): bool {
    connect();
    global $connection;

    $sql = "DELETE FROM users WHERE user_id=$user_id";
    if ($connection->query($sql) === TRUE) {
        disconnect();
        return true;
    } else {
        disconnect();
        return false;
    }
};