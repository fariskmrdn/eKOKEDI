<?php


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: ' . $target);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM occupants
JOIN occupants_profiles ON occupants.occ_id = occupants_profiles.occ_id
JOIN programme ON occupants.programme_id = programme.programme_id
JOIN rooms ON occupants.room_id = rooms.room_id
WHERE occupants.occ_id = ?");
$stmt->execute([$_SESSION['occupants_id']]);
$student = $stmt->fetch();