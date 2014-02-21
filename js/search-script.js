function fetchPage(e) {
    var page;
    if (/^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/.test(e)) { //is a number
        page = e;
    } else { //is clicked element
        page = $(e).text();
    }
    var players;
    console.log("Getting players at page " + page);
    $.ajax({
        type: "GET",
        url: "../inc/ajax/search.php",
        dataType: 'json',
        data: {
            page: page,
            finder: "l"
        }
    })
            .done(function(msg) {
                console.log("Got " + msg);

                var totalPages;

                $('#search-list').empty();
                players = msg;
                console.log(JSON.stringify(players));
                $.each(players, function(index) {
                    if (index === 0) {
                        //only info
                        totalPages = players[index];
                        return true; //acts like continue
                    }
                    var player = players[index];
                    var online;
                    var lastjoin = new Date(1000 * player['lastjoin']);
                    var lastleave = new Date(1000 * player['lastleave']);
                    if (lastjoin > lastleave) {
                        online = "Online now!";
                    } else {
                        online = lastleave.toLocaleString();
                    }

                    $("#search-list")
                            .append($('<tr>')
                                    .append($('<td>')
                                            .append($('<a>')
                                                    .attr('href', 'player.php?id=\'' + player['player_id'] + "'")
                                                    .append($('<img>')
                                                            .attr('src', 'http://mc-avatar.developgravity.com/' + player["name"] + "/16")//TODO make this dynamic
                                                            .addClass("img-rounded").addClass("avatar-list-icon")
                                                            ).append(" " + player["name"])
                                                    )
                                            ).append($('<td>').append(online)
                                    )
                                    );
                }); //end of each loop
                page = parseInt(page);
                totalPages = parseInt(totalPages);
                console.log("Total pages : " + totalPages);
                console.log("Current page: " + page);
                var pagination = $(".pagination");
                pagination.empty();
                pagination.append($("<li>").addClass(page === 1 ? "disabled" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(" + (page - 1) + ")").html("&laquo;")));
                pagination.append($("<li>").addClass(page === 1 ? "active" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(this)").html(page <= 2 ? "1" : ((totalPages - page <= 1) ? (totalPages - 4) : (page - 2)))));
                if(totalPages > 2){
                    pagination.append($("<li>").addClass(page === 2 ? "active" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(this)").html(page <= 2 ? "2" : ((totalPages - page <= 1) ? (totalPages - 3) : (page - 1)))));
                }
                if(totalPages > 3){
                    pagination.append($("<li>").addClass(page !== 1 && page !== 2 && page !== totalPages && page !== (parseInt(totalPages) - 1) ? "active" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(this)").html(totalPages - page <= 2 ? (totalPages-2) : (page > 2 ? page : "3"))));
                }
                if(totalPages > 4){
                    pagination.append($("<li>").addClass(totalPages - 1 === page ? "active" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(this)").html(page <= 2 ? "4" : ((totalPages - page <= 1) ? (totalPages - 1) : (page + 1)))));
                }
                if(totalPages > 5){
                    pagination.append($("<li>").addClass(page === totalPages ? "active" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(this)").html(page <= 2 ? "5" : ((totalPages - page <= 1) ? (totalPages) : (page + 2)))));
                }
                pagination.append($("<li>").addClass(page === totalPages ? "disabled" : "").append($("<a>").attr("href", "javascript:void(0)").attr("onclick", "fetchPage(" + (page + 1) + ")").html("&raquo;")));
                
                

            }); //end of done function and ajax call
}