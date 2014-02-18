function isNumber(o) {
    return !isNaN(o - 0) && o !== null && o.replace(/^\s\s*/, '') !== "" && o !== false;
}

function fetchPage(e) {
    if (isNumber(e)) {
        var players;
        //instantly fetch page
        $.post(
                "../inc/ajax/search.php",
                {
                    page: 0,
                    finder: "l"
                },
                function(msg) {
                    players = msg;
                }, "json");
    }
}