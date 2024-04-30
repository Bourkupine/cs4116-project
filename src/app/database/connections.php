<?php

function get_connections(mysqli $db_con, int $user_id): array
{
    $stmt = $db_con->prepare("SELECT user_id, first_name, surname,  profile_pic, connection_id 
                                      FROM profiles 
                                      INNER JOIN connections 
                                      ON ((user_1_id = user_id AND user_2_id = ?)
                                      OR (user_2_id = user_id AND user_1_id = ?))");
    $stmt->bind_param("ii", $user_id, $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_aLL(MYSQLI_ASSOC);
}


