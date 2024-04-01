<?php

require 'database-connect.php';
require '../models/user.php';

function create_user(mysqli $connection, string $email, string $password): bool {
    $sql = "INSERT INTO users (email, password, account_type)
VALUES ($email, $password, 'user')";

    if ($connection->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function get_user_by_id(mysqli $connection, int $user_id): user {
    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return new user($result['user_id'], $result['email'], $result['password'], $result['account_type']);
    } else {
        throw new mysqli_sql_exception();
    }
}

function get_user_by_email(mysqli $connection, string $email): user {
    $sql = "SELECT * FROM users WHERE email=$email";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return new user($result['user_id'], $result['email'], $result['password'], $result['account_type']);
    } else {
        throw new mysqli_sql_exception();
    }
}

function delete_user_by_user_id(mysqli $connection, int $user_id): bool {
    $sql = "DELETE FROM users WHERE user_id=$user_id";
    if ($connection->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}