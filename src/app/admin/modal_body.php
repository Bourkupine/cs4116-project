<?php

require_once "../database/users.php";
require_once "../database/user_interests.php";
require_once "../database/interests.php";

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
    echo "
        <p>You are about to ban user:</p>
        <ul>
            <li>id: $user_info[0]</li>
            <li>Name: $user_info[1] $user_info[2]</li>
        </ul>
        <input class='form-control' type='text' placeholder='Reason' name='ban-reason'>
        <select class='form-control' name='ban-time'>
            <option value='+1 day'>1 Day</option>
            <option value='+2 days'>2 Days</option>
            <option value='+7 days'>1 Week</option>
            <option value='+1 month'>1 Month</option>
            <option value='+1000 years'>Permanent</option>
        </select>
        <input type='hidden' name='user-id' value='$user_info[0]'>
    ";
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

function edit_account_body(mysqli $db_con, array $user_info): void
{
    $profile_details = get_profile_details($db_con, $user_info[0]);
    $bio = $profile_details["bio"];
    $pfp = $profile_details["profile_pic"];
    if (!$pfp) { $pfp = "../../assets/pfp-placeholder.png"; }
    $user_interests = get_user_interests_by_user_id($db_con, $user_info[0]);
    $interests = get_all_interests($db_con);

    echo "
        <p>You are about to edit user:</p>
            <div><b>Id:</b> $user_info[0]</div>
            <div><b>Name:</b> $user_info[1] $user_info[2]</div>
            <div style='word-wrap: break-word'><b>Bio:</b> $bio</div>
            <div style='text-align: center'><b>Profile Picture: </b></div>
            <div style='display: flex; justify-content: center; object-fit: contain'><img style='max-width: 300px;' src=$pfp></div>
            <div class='pb-2'><b>Interests: </b>";

    foreach ($user_interests as $interest) {
        echo $interests[$interest] . " ";
    }

    echo "
            </div>
        
        <input type='checkbox' class='btn-check btn-danger' id='btn1' autocomplete='off' name='remove-pfp'>
        <label class='btn btn-outline-danger' for='btn1'>Remove Profile Pic</label>
        
        <input type='checkbox' class='btn-check btn-danger' id='btn2' autocomplete='off' name='remove-bio'>
        <label class='btn btn-outline-danger' for='btn2'>Remove Bio</label>
        
        <input type='checkbox' class='btn-check btn-danger' id='btn3' autocomplete='off' name='remove-interests'>
        <label class='btn btn-outline-danger' for='btn3'>Remove Interests</label>
        
        <input type='hidden' name='user-id' value='$user_info[0]'>
    ";
}

?>