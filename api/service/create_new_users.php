<?php

function create_new_users(mysqli $db, string $username, string $password): bool
{
    try {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
