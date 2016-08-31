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
    $alternativeNames = $_POST['alternativeNames'];

    if(isset ($_POST['imageName'])  &&  !empty($_POST['imageUrl'])) {
        $postImageName = str_replace (" ","",$_POST['imageName']);
        $imageName = $postImageName.".png";
        @$internetImage = file_get_contents($_POST['imageUrl']);
        file_put_contents("playerImages/".$imageName,$internetImage);
    }

    $sql = $db->prepare("INSERT INTO player
        (nickname, image_url, twitter_id, facebook_id, twitch_id, steam_id, dota2_id, wiki_url, alternative_names)
        VALUES
        (:nickName, :imageName, :twitterID, :facebookID, :twitchID, :steamID, :dota2ID, :wikiUrl), :alternativeNames");

    $sql->execute(array(
        ':nickName' => $nickName,
        ':imageName' => $imageName,
        ':twitterID' => $twitterID,
        ':facebookID' => $facebookID,
        ':twitchID' => $twitchID,
        ':steamID' => $steamID,
        ':dota2ID' => $dota2ID,
        ':wikiUrl' => $wikiUrl,
        ':alternativeNames' => $alternativeNames
    ));
}