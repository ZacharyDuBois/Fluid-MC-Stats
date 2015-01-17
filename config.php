<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

/**
 * MySQL
 */

// MySQL Host.
$mysql_host = '';
// MySQL Port.
$mysql_port = '';
// MySQL Database.
$mysql_database = '';
// Stats prefix - Found in Stats plugin config.
$mysql_table_prefix = 'Stats_';
// MySQL User.
$mysql_user = '';
// MySQL Password.
$mysql_pwd = '';

/**
 * Minecraft Server
 */

// Your Minecraft server name.
$server_name = '';
// An A Record, AAAA Record, CNAME Record or IP to your Minecraft server without the port.
$mc_server_ip = '';
// Port Number to your Minecraft server.
$mc_server_port = '';
// A 'nice' address for your Minecraft server. This will be the address that is displayed on the web interface.
$mc_server_disp_addr = '';
// The URL to a custom image to use as the server icon. If not set, we will use the server-icon.png on your Minecraft server.
$mc_custom_icon = '';

/**
 * Fluid MC Stats Interface Config
 */

// Name that will appear in page title and navbar.
$site_name = '';
// The FontAwesome icon you want to be next to your web end title. Use ending only. Ex: Icon you want to use "fa-bookmark-o" Just enter "bookmark-o".
$fa_icon = '';
// Stat that gets used to sort the players
$player_top_calc_stat = '';
// Number of player on top list.
$player_on_top = 10;
// Custom text added into the footer.
$custom_footer_text = '';
// Links displayed in navbar and sidebar. Add as many as you need (Only add up to 5 from the auto install).
$custom_links = array(
    "Develop Gravity" => "http://developgravity.com/",
    "Lolmewn"         => "http://lolmewn.nl/",
    "Mojang"          => "http://mojang.com/",
);
// Hides the limited feature box when MinecraftQuery.php cannot query your server.
$hide_limited_feature_warning = false;

/**
 * Advanced User's Options
 */

/* DO NOT EDIT BELOW THIS LINE! */

/**
 * Custom URL in case you want to use a different server for file hosting. Leave blank for using the same server.
 * To use, upload the img, font-awesome, bootstrap, css, and js directories to the server of your choice and put the URI to them below.
 * It is recommended not to delete these directories off of this server in-case we forget to implement this in some files.
 * These are also still required to be on the local server as the install requires them.
 */
$custom_hosted_uri = '';
// Specify required time, in seconds, players need to be included in global stats generation.
$required_global_stats_time = 3600; // 1 Hour
// This setting defines the base URL to your FMCS install. Leave blank for subdoamin (root) install. For subdirectories, put the full URI to the install root without beginning slash.
$base_URL = '/';
// URI for Avatars. Must follow domain.tld/playername/size. Leave as http://mctar.ws/ for ours.
$avatar_service_uri = '';
// Enable the debugging script.
$debug = false;
