var liveticker = {
	config: {
		interval: 10,
		url:      ''
	},
	players: {}
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
				$(data).each(function(index, data){
					if (liveticker.players[data.player_id] !== undefined) {
						var blockdiff = 0;
						
						if (liveticker.players[data.player_id].traveled !== data.traveled) {
							blockdiff = (data.traveled - liveticker.players[data.player_id].traveled);
							blockdiff = parseInt(blockdiff, 10);
							
							$row = $('<tr />');
							$row.append('<td>' + data.name + '</td>');
							$row.append('<td>moved ' + blockdiff + ' blocks</td>');
							liveticker.item.find('tr').addClass('old');
							liveticker.item.prepend($row);
						}
					}
					
					liveticker.players[data.player_id] = data;
				});
				
				liveticker.schedule();
			},
			error: function(jqXHR, textStatus, errorThrown){
				$row = $('<tr />');
				
				$row.append('<td colspan="2">There was an problem while loading the data. Please try again later.</td>');
				
				liveticker.item.prepend($row);
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