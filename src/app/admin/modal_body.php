<?php

function delete_account_body(array $user_info)
{
    echo "
        <p>You are about to delete User:</p>
        <ul>
            <li>id: $user_info[0]</li>
            <li>Name: $user_info[1] $user_info[2]</li>
        </ul>
        <input type='hidden' name='user-id' value='$user_info[0]'>
    ";
}
?>