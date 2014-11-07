/**
 * Provides the live-ticker-client.
 * 
 * @package    FluidMCStats
 * @subpackage Logic
 * @author     Oliver Lippert <info@lipperts-web.de>
 * @copyright  2014-2014 AccountProductions, Sybren Gjaltema and Oliver Lippert
 */
var liveticker = {
	config: {
		interval: 10,
		url:      ''
	},
	players: {},
	utils: {},
	onlinePlayers: {}
};

liveticker.init = (function(){
	$(document).ready(function(){
		liveticker.item = $('#live-ticker');
		
		liveticker.update();
	});
}());

liveticker.update = function(){
	$.ajax(
		liveticker.config.url,
		{
			cache:    false,
			dataType: "json",
			success:  function(data, textStatus, jqXHR){
				liveticker.item.find('tr').addClass('old');

				var online = 0;
				$(data).each(function(index, data){
					if (liveticker.players[data.player_id] !== undefined) {
						var traveldiff = 0;
						var placediff  = 0;
						var brokediff  = 0;

						traveldiff = (data.traveled - liveticker.players[data.player_id].traveled);
						traveldiff = parseInt(traveldiff, 10);
						
						placediff = (data.placed - liveticker.players[data.player_id].placed);
						placediff = parseInt(placediff, 10);
						
						brokediff = (data.broke - liveticker.players[data.player_id].broke);
						brokediff = parseInt(brokediff, 10);
						
						if (traveldiff !== 0) {
							liveticker.utils.addPlayerAction(data.name, 'traveled ' + traveldiff + ' blocks');
						}

						if (placediff !== 0) {
							liveticker.utils.addPlayerAction(data.name, 'placed ' + placediff + ' blocks');
						}

						if (brokediff !== 0) {
							liveticker.utils.addPlayerAction(data.name, 'broke ' + brokediff + ' blocks');
							
						}
					}
					
					if (liveticker.utils.isOnline(data) === true) {
						online++;
						
						// Player is online, check if he was offline.
						if (liveticker.onlinePlayers[data.player_id] === undefined) {
							liveticker.utils.addPlayerAction(data.name, 'came online');
							
							liveticker.onlinePlayers[data.player_id] = true;
						}
					} else {
						// Player is offline, check if he was online.
						if (liveticker.onlinePlayers[data.player_id] !== undefined) {
							liveticker.utils.addPlayerAction(data.name, 'went offline');
							
							liveticker.onlinePlayers[data.player_id] = undefined;
						}
					}
					
					liveticker.players[data.player_id] = data;
				});
				
				if (online === 0) {
					liveticker.utils.addInfo('Currently there is no one playing on this server.');
				}
				
				liveticker.schedule();
			},
			error: function(jqXHR, textStatus, errorThrown){
				liveticker.utils.addInfo('There was an problem while loading the data. Please try again later.');
			}
		}
	);
};

liveticker.schedule = function(){
	setTimeout(
		liveticker.update,
		liveticker.config.interval * 1000
	);
};

liveticker.utils.isOnline = function (playerdata) {
	ret = false;
	
	var lastJoined = new Date(playerdata.lastjoin.replace('-', '/'));
	var lastLeft   = new Date(playerdata.lastleave.replace('-', '/'));
	
	if (lastLeft < lastJoined) {
		ret = true;
	}
	
	return ret;
};

liveticker.utils.addPlayerAction = function (name, action) {
	$row = $('<tr />');
	$row.append('<td>' + name + '</td>');
	$row.append('<td>' + action + '</td>');
	liveticker.item.prepend($row);
};

liveticker.utils.addInfo = function (info) {
	$row = $('<tr />');
	$row.append('<td colspan="2">' + info + '</td>');
	liveticker.item.prepend($row);
};