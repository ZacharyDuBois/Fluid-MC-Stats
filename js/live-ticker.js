/**
 * Provides the live-ticker-client.
 *
 * @package    FluidMCStats
 * @subpackage Logic
 * @author     Oliver Lippert <info@lipperts-web.de>
 * @copyright  2014-2014 AccountProductions, Sybren Gjaltema and Oliver Lippert
 */
var liveticker = {
  config       : {
    interval: 10,
    url     : installDir + 'inc/ajax/live-ticker.php'
  },
  players      : {},
  utils        : {},
  onlinePlayers: {},
  steps        : {
    traveled: [
      1000,
      50000,
      100000,
      250000,
      500000,
      750000,
      1000000
    ],
    placed  : [
      1000,
      50000,
      100000,
      250000,
      500000,
      750000,
      1000000
    ],
    broke   : [
      1000,
      50000,
      100000,
      250000,
      500000,
      750000,
      1000000
    ],
    playtime: [
      (0.5 * 60 * 60),
      (1 * 60 * 60),
      (5 * 60 * 60),
      (10 * 60 * 60),
    ]
  }
};

liveticker.init = (function () {
  $(document).ready(function () {
    liveticker.item = $('#live-ticker');

    $('#liveTickerInterval').change(function () {
      liveticker.config.interval = parseInt($(this).val(), 10);
    });

    $('#reloadLiveTickerSeconds').text(liveticker.config.interval);
    setInterval(
        function () {
          $('#reloadLiveTickerSeconds').text(parseInt($('#reloadLiveTickerSeconds').text(), 10) - 1);
        },
        1000
    );

    liveticker.update();
  });
}());

liveticker.update = function () {
  $.ajax(
      liveticker.config.url,
      {
        cache   : false,
        dataType: "json",
        success : function (data, textStatus, jqXHR) {
          liveticker.item.find('tr').addClass('old');

          var online = 0;
          $(data).each(function (index, data) {
            if (liveticker.players[data.player_id] !== undefined) {
              liveticker.utils.logStat(data.name, data.player_id, 'traveled', data.traveled, liveticker.players[data.player_id].traveled);
              liveticker.utils.logStat(data.name, data.player_id, 'placed', data.placed, liveticker.players[data.player_id].placed);
              liveticker.utils.logStat(data.name, data.player_id, 'broke', data.broke, liveticker.players[data.player_id].broke);

              liveticker.utils.logBlockHighscore(data.name, data.player_id, 'traveled', liveticker.steps.traveled, data.traveled, liveticker.players[data.player_id].traveled);
              liveticker.utils.logBlockHighscore(data.name, data.player_id, 'placed', liveticker.steps.placed, data.placed, liveticker.players[data.player_id].placed);
              liveticker.utils.logBlockHighscore(data.name, data.player_id, 'broke', liveticker.steps.broke, data.broke, liveticker.players[data.player_id].broke);
              liveticker.utils.logPlaytimeHighscore(data.name, data.player_id, data.playtime, liveticker.players[data.player_id].playtime);
            }

            if (liveticker.utils.isOnline(data) === true) {
              online++;

              // Player is online, check if he was offline.
              if (liveticker.onlinePlayers[data.player_id] === undefined) {
                liveticker.utils.addInfo(data.name + ' connected');

                liveticker.onlinePlayers[data.player_id] = true;
              }
            } else {
              // Player is offline, check if he was online.
              if (liveticker.onlinePlayers[data.player_id] !== undefined) {
                liveticker.utils.addInfo(data.name + ' disconnected');

                liveticker.onlinePlayers[data.player_id] = undefined;
              }
            }

            liveticker.players[data.player_id] = data;
          });

          if (online === 0) {
            liveticker.utils.addInfo('Currently, there is no one playing on this server.');
          }

          liveticker.schedule();
        },
        error   : function (jqXHR, textStatus, errorThrown) {
          liveticker.utils.addInfo('There was an problem while loading the data. Please try again later.');
        }
      }
  );
};

liveticker.schedule = function () {
  setTimeout(
      liveticker.update,
      liveticker.config.interval * 1000
  );
  $('#reloadLiveTickerSeconds').text(liveticker.config.interval);
};

liveticker.utils.isOnline = function (playerdata) {
  ret = false;

  var lastJoined = new Date(playerdata.lastjoin.replace(/-/g, '/'));
  var lastLeft = new Date(playerdata.lastleave.replace(/-/g, '/'));

  if (lastLeft < lastJoined) {
    ret = true;
  }

  return ret;
};

liveticker.utils.addPlayerAction = function (name, id, action) {
  $row = $('<tr />');
  $row.append('<td><img src="' + avatarURI + name + '/16" class="img-circle avatar-list-icon"> <a href="' + installDir + 'players/' + id + '" title="' + name + '&apos;s Stats">' + name + '</td>');
  $row.append('<td>' + action + '</td>');
  liveticker.item.prepend($row);
};

liveticker.utils.addInfo = function (info, highlight) {
  if (highlight === undefined) {
    $row = $('<tr />');
  } else {
    $row = $('<tr class="highlight" />');
  }

  $row.append('<td colspan="2">' + info + '</td>');
  liveticker.item.prepend($row);
};

liveticker.utils.logStat = function (name, id, stat, curValue, lastValue) {
  var diff = (curValue - lastValue);
  diff = parseInt(diff, 10);

  if (diff !== 0) {
    liveticker.utils.addPlayerAction(name, id, stat + ' ' + diff + ' blocks');
  }
};

liveticker.utils.logBlockHighscore = function (name, id, stat, steps, curValue, lastValue) {
  var logged = false;

  $(steps).each(function (index, value) {
    if (lastValue < value && curValue >= value) {
      logged = true;

      liveticker.utils.addInfo(name + ' ' + stat + ' ' + value + ' blocks');
    }
  });

  if (logged === false) {
    var maxVal = steps[steps.length - 1];

    lastValue = (lastValue / maxVal) - 0.5;
    curValue = (curValue / maxVal) - 0.5;

    lastValue = Math.round(lastValue, 0);
    curValue = Math.round(curValue, 0);

    if (curValue !== lastValue) {
      liveticker.utils.addInfo(name + ' ' + stat + ' ' + (curValue * maxVal) + ' blocks', true);
    }
  }
};

liveticker.utils.logPlaytimeHighscore = function (name, id, curValue, lastValue) {
  var logged = false;

  $(liveticker.steps.playtime).each(function (index, value) {
    if (lastValue < value && curValue >= value) {
      logged = true;

      liveticker.utils.addInfo(name + ' played ' + (value / 60 / 60) + ' hours');
    }
  });

  if (logged === false) {
    lastValue = (lastValue / 86400) - 0.5;
    curValue = (curValue / 86400) - 0.5;

    lastValue = Math.round(lastValue, 0);
    curValue = Math.round(curValue, 0);

    if (curValue !== lastValue) {
      liveticker.utils.addInfo(name + ' played for ' + curValue + ' days', true);
    }
  }
};