<?php
session_start();
require("bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $levelNumber = isset($data['level']) ? intval($data['level']) : 0;
    $win = isset($data['win']) ? intval($data['win']) : 0;

    if ($win === 1) {
        if (!empty($_SESSION['pseudo'])) {
            if ($_SESSION['progression'] == $levelNumber) {
                $_SESSION['progression'] += 1;
                $update = $conn->prepare("UPDATE `comptes` SET `progression` = :progression WHERE pseudo = :pseudo");
                $update->execute(
                    array(
                        ':progression' => $_SESSION['progression'],
                        ':pseudo' => $_SESSION['pseudo'],
                    )
                );
            }
        } else {
            $_SESSION['progression'] += 1;
        }
    }

    echo json_encode(['status' => 'success']);
}
?>
