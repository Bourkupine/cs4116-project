<?php

require 'database-connect.php';
require '../models/profile.php';

function create_profile(profile $profile): bool {
    connect();
    global $connection;

    $sql = "INSERT INTO profiles 
VALUES ({$profile->getUserId()}, {$profile->getFirstName()}, {$profile->getSurname()}, {$profile->getAge()}, {$profile->getSex()},
        {$profile->getPreference()}, {$profile->getBio()}, {$profile->getProfilePic()}, {$profile->getCountry()}, {$profile->getRegion()})";

    if ($connection->query($sql) === TRUE) {
        disconnect();
        return true;
    } else {
        disconnect();
        return false;
    }
}