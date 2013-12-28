$("#mysql-test").click(function() {
    $.ajax({
        url: "mysql-test.php",
        type: "POST",
        data: {
            mh: $("#mySQLHost").val(),
            mp: $("#mySQLHostPort").val(),
            mdb: $("#mySQLDatabaseName").val(),
            mu: $("#mySQLUser").val(),
            mpa: $("#mySQLPassword").val()
        }
    }).done(function(msg) {
        if (msg === "Success") {
            $("#mysql-test").fadeOut(200, function() {
                $("#mysql-result").html("<h2><span class='label label-success'>Success!</span></h2>");
            });
        } else {
            $("#mysql-result").html("<h2><span class='label label-danger'>Failed: " + msg + "</span></h2>");
        }
    });
    return false;
});

