<?php
require_once('/home/santino/www/symfony_test/api/PDO.php');
if( $_POST['value'] ) {
    $stringData = $_POST['value'];
    $sql = $db->prepare("SELECT * FROM player WHERE player_ID = :stringData");
    $sql->bindValue(':stringData', $stringData);
    $sql->execute();
    $results = $sql->fetchAll();
    echo json_encode($results);
}