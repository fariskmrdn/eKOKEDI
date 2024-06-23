<?php



require_once('config.php');



if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {

    header('Location: ' . $target);

    exit;

}



if(isset($_SESSION['occupants_id'])){
    $stmt = $pdo->prepare("SELECT * FROM occupants

    JOIN occupants_profiles ON occupants.occ_id = occupants_profiles.occ_id
    	
    JOIN rooms ON occupants.room_id = rooms.room_id
    
    WHERE occupants.occ_id = ?");
    
    
    $stmt->execute([$_SESSION['occupants_id']]);
    
    $student = $stmt->fetch();
}



if(isset($_SESSION['admin_id'])){
    $admt = $pdo->prepare("SELECT * FROM admins WHERE admin_id = ?");

    $admt->execute([$_SESSION['admin_id']]);
    
    $admin = $admt->fetch();
}
