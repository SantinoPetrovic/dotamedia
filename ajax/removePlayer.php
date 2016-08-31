<?php
require_once('/home/santino/www/symfony_test/api/PDO.php');
unlink("playerImages/".$_POST['imageName']);
if( $_POST['playerID'] ) {
    $stringData = $_POST['playerID'];

    $sql1 = $db->prepare("DELETE FROM player_information WHERE player_ID = :stringData");
    $sql1->bindValue(':stringData', $stringData);
    $sql1->execute();

    $sql2 = $db->prepare("DELETE FROM player_matches WHERE playerID = :stringData");
    $sql2->bindValue(':stringData', $stringData);
    $sql2->execute();

    $sql3 = $db->prepare("DELETE FROM player_twitter WHERE player_ID = :stringData");
    $sql3->bindValue(':stringData', $stringData);
    $sql3->execute();

    $sql = $db->prepare("DELETE FROM player WHERE player_ID = :stringData");
    $sql->bindValue(':stringData', $stringData);
    $sql->execute();
}