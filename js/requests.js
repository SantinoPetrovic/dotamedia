$(document).ready(function() {
    var editPlayer;
    $(".editButton").click(function() {
        var value = $(this).attr('value');
        var datas = "value="+value;
        editPlayer = true;
        $.ajax({
            type: 'post',
            url: 'ajax/getEditPlayer.php',
            data: datas,
            success: function( data ) {
                $('.submitButton').addClass('editPlayer');
                $(".playerTable, .newForm").addClass('hide');
                $(".playerFormular").removeClass('hide');
                var myArray = JSON.parse(data);
                $(".nickName").val(myArray[0]["nickname"])
                $(".twitterID").val(myArray[0]["twitter_id"]);
                $(".facebookID").val(myArray[0]["facebook_id"]);
                $(".twitchID").val(myArray[0]["twitch_id"]);
                $(".steamID").val(myArray[0]["steam_id"]);
                $(".dota2ID").val(myArray[0]["dota2_id"]);
                $(".wikiUrl").val(myArray[0]["wiki_url"]);
                $(".alternativeNames").val(myArray[0]["alternative_names"]);
                var playerID = myArray[0]["player_ID"];
                var imageUrl = myArray[0]["image_url"];
                if(imageUrl.length > 0){
                    var imageName = imageUrl.slice(0, -4);
                }
                var oldImageName = imageUrl;
                $(".imageName").val(imageName);
                $(".editPlayer").click(function(){
                    var playerFormular = $('.playerFormular').serializeArray();
                    playerFormular.push({ name:"playerID", value: playerID });
                    playerFormular.push({ name:"oldImageName", value: oldImageName });
                    console.log(playerFormular);
                    $.ajax({
                        type: 'post',
                        url: 'ajax/editPlayer.php',
                        data: playerFormular,
                        success: function() {
                            alert("Saved changes!");
                            $( ".backToTable" ).trigger( "click" );
                        }
                    });
                    return false;
                });
            }
        });
    });

    $(".newForm").click(function(){
        $('.submitButton').addClass('addNewPlayer');
        $(".playerTable, .newForm").addClass('hide');
        $(".playerFormular").removeClass('hide');
        $(".addNewPlayer").click(function(){
           var playerFormular = $('.playerFormular').serializeArray();
           console.log(playerFormular);
            $.ajax({
                type: 'post',
                url: 'ajax/newPlayer.php',
                data: playerFormular,
                success: function() {
                    alert("Added new player in database!");
                    $( ".backToTable" ).trigger( "click" );
                }
            });
           return false;
        });
    });

    $(".backToTable").click(function(){
        $(".playerFormular").addClass('hide');
        $(".playerTable, .newForm").removeClass('hide');
        $('.submitButton').removeClass('addNewPlayer');
        $('.submitButton').removeClass('editPlayer');
    })

    $(".removeButton").click(function(){
        var confirmDelete = confirm("Do you want to delete "+ $(this).attr("nickname") +" from the database?");
        if (confirmDelete == true) {
            console.log("this works");
            var playerID = $(this).attr('value');
            var imageName = $(this).attr('image');
            var playerFormular = [];
            playerFormular.push({ name:"playerID", value: playerID });
            playerFormular.push({ name:"imageName", value: imageName });
            console.log(playerFormular);
            $.ajax({
                type: 'post',
                url: 'ajax/removePlayer.php',
                data: playerFormular,
                success: function() {
                    alert("Removed player from the database!");
                    location.reload();
                }
            });
        }
    });
    $(".searchPlayerSubmit").click(function(){
        var searchValue = $(".searchPlayerInput").val();
        searchValue = searchValue.replace(/[`!@#$%&*()|+\-=?;:'"¤,.<>\{\}\[\]\\\/]/gi, '');
        if(searchValue.length > 20) {
            alert("You can't search more than 20 characters");
        }
        else if(searchValue.length > 0 ) {
            window.location = "http://46.101.160.201:8000/search/"+searchValue;
        }
        else {
            alert("You can't search with only special characters or empty field. Please, search with alphabetic characters or words.");
        }
        return false;
    });
});