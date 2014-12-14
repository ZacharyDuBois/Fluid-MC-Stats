<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

/**
 * MySQL
 */
$mysql_host = ''; // MySQL Host.
$mysql_database = ''; // MySQL Database.
$mysql_port = ''; // MySQL Port.
$mysql_user = ''; // MySQL User.
$mysql_pwd = ''; // MySQL Password.
$mysql_table_prefix = ''; // Stats prefix - Found in Stats plugin config.

/**
 * Minecraft Server
 */
$server_name = ''; // Your Minecraft server name.
$mc_server_ip = ''; // An A Record, AAAA Record, CNAME Record or IP to your Minecraft server without the port.
$mc_server_port = ''; // Port Number to your Minecraft server.
$mc_server_disp_addr = ''; // A 'nice' address for your Minecraft server. This will be the address that is displayed on the web interface.

/**
 * Fluid MC Stats Interface Config
 */
$site_name = ''; // Name that will appear in page title and navbar.
$fa_icon = ''; // The FontAwesome icon you want to be next to your web end title. Use ending only. Ex: Icon you want to use "fa-bookmark-o" Just enter "bookmark-o".
$avatar_service_uri = ''; // URI for Avatars. Must follow domain.tld/playername/size. Leave as http://mctar.ws/ for ours.
$player_top_calc_stat = ''; // Stat that gets used to sort the players
$player_on_top = ''; //Number of player on top list.
$custom_footer_text = ''; // Custom text added into the footer.
$custom_links = array( // Links displayed in navbar and sidebar. Add as many as you need (Only add up to 5 from the auto install).
    "Develop Gravity" => "http://developgravity.com/",
    "Lolmewn"         => "http://lolmewn.nl/",
    "Mojang"          => "http://mojang.com/",
);
$mc_custom_icon = ''; // The URL to a custom image to use as the server icon. If not set, we will use the server-icon.png on your Minecraft server.

/**
 * Advanced User's Options
 */

/* DO NOT EDIT BELOW THIS LINE! */

/**
 * Custom URL in case you want to use a different server for file hosting. Leave blank for using the same server.
 * To use, upload the img, font-awesome, bootstrap, css, js, and less directories to the server of your choice and put the URI to them below.
 * It is recommended not to delete these directories off of this server in-case we forget to implement this in some files.
 * These are also still required to be on the local server as the install requires them.
 */
$custom_hosted_uri = '';

/**
 * Specify required time, in seconds, players need to be included in global stats generation.
 */
$required_global_stats_time = '3600'; // 1 Hour
