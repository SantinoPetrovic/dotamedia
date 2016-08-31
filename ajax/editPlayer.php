<?php
require_once('/home/santino/www/symfony_test/api/PDO.php');
if( $_POST['nickName'] ) {
    $nickName = $_POST['nickName'];
    $twitterID = $_POST['twitterID'];
    $facebookID = $_POST['facebookID'];
    $twitchID = $_POST['twitchID'];
    $steamID = $_POST['steamID'];
    $dota2ID = $_POST['dota2ID'];
    $wikiUrl = $_POST['wikiUrl'];
    $playerID = $_POST['playerID'];
    $alternativeNames = $_POST['alternativeNames'];

    if(!empty($_POST['imageName'])  &&  !empty($_POST['imageUrl'])) {
        $postImageName = str_replace (" ","",$_POST['imageName']);
        $imageName = $postImageName.".png";
        @$internetImage = file_get_contents($_POST['imageUrl']);
        unlink("playerImages/".$_POST['oldImageName']);
        file_put_contents("playerImages/".$imageName,$internetImage);
    }
    elseif (!empty($_POST['imageName'])  &&  empty($_POST['imageUrl'])) {
        $imageName = $_POST['imageName'].".png";
        rename("playerImages/".$_POST['oldImageName'], "playerImages/".$imageName);
    }

    $sql = $db->prepare("UPDATE player
        SET nickname = :nickName, image_url = :imageName, twitter_id = :twitterID, facebook_id = :facebookID, twitch_id = :twitchID, steam_id = :steamID, dota2_id = :dota2ID, wiki_url = :wikiUrl, alternative_names = :alternativeNames
        WHERE player_ID = :playerID");

    $sql->execute(array(
        ':nickName' => $nickName,
        ':imageName' => $imageName,
        ':twitterID' => $twitterID,
        ':facebookID' => $facebookID,
        ':twitchID' => $twitchID,
        ':steamID' => $steamID,
        ':dota2ID' => $dota2ID,
        ':wikiUrl' => $wikiUrl,
        ':playerID' => $playerID,
        'alternativeNames' => $alternativeNames

    ));
}