<?php

function delete_account_body(array $user_info): void
{
    echo "
        <p>You are about to delete user:</p>
        <ul>
            <li>id: $user_info[0]</li>
            <li>Name: $user_info[1] $user_info[2]</li>
        </ul>
        <input type='hidden' name='user-id' value='$user_info[0]'>
    ";
}

function ban_account_body(array $user_info): void
{

}

function unban_account_body(array $user_info, array $ban_info): void
{
    echo "
        <p>You are about to unban user:</p>
        <ul>
            <li>id: $user_info[0]</li>
            <li>Name: $user_info[1] $user_info[2]</li>
            <li>Expiry Date: $ban_info[0]</li>
            <li>Reason: $ban_info[1]</li>
        </ul>
        <input type='hidden' name='user-id' value='$user_info[0]'>
    ";
}

function edit_account_body(array $user_info): void
{

}

?>