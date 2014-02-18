function isNumber(o) {
    return !isNaN(o - 0) && o !== null && o.replace(/^\s\s*/, '') !== "" && o !== false;
}

function fetchPage(e) {
    var page;
    if (isNumber(e)) {
        page = e;
    }else{
        
    }
    var players;
    $.post("../inc/ajax/search.php",
            {
                page: page,
                finder: "l"
            },
    function(msg) {
        $('#search-list').empty();
        players = msg;
        for (var player in players) {
            console.log(player);
            $("#search-list")
                    .append($('<tr>')
                            .append($('<td>')
                                    .append($('<a>')
                                            .attr('href', 'player.php?id=\'' + player['id'] + "'")
                                            ).append($('<img>')

                                    )
                                    )
                            );
        }
    }, "json");

}