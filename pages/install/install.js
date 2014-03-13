/*
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

$("#mySQLHostPort, #mcResolveAddrPort, #fmcsAdvCacheTime, #fmcsAdvGlobalNeededTime").keypress(function (event) {
  if (String.fromCharCode(event.keyCode).match(/[^0-9]/g))
    event.preventDefault();
});

$("#install-button").click(function () {
  var verified = true;
  $("#install-form").find(":input").each(function () {
    if ($(this).is("[needed]")) {
      if (!$(this).val()) {
        verified = false;
        $(this).closest(".form-group").find("label").css("color", "red");
      } else {
        $(this).closest(".form-group").find("label").css("color", "green");
      }
    } else {
      $(this).closest(".form-group").find("label").css("color", "green");
    }
  });
  if (!verified) {
    $("#install-button").removeClass("btn-success");
    $("#install-button").addClass("btn-danger");
    $("#install-button").text("Some values are still empty!");
    return false;
  }
  $.post("../../pages/install/save-settings.php", $("#install-form").serialize(), function (data) {
    console.log("Got back: " + data);
    if (data == "Success") {
      window.location.replace($(location).attr('protocol') + "//" + $(location).attr('host') + $(location).attr("pathname") + "/../../../index.php");
    }
  });
  return false;
});
