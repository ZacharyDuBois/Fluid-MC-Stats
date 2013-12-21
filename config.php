<?php
/**
 * Copyright (c) Develop Gravity and Lolmewn 2013. All Rights Reserved.
 */

/**
 * PHP
 */
$site_url = ''; // URL to the site. Do not add trailing slash. Ex: http://developgravity.com.

$mysql_host = 'localhost'; // MySQL Host.
$mysql_port = '3306'; // MySQL Port.
$mysql_database = 'Stats'; // MySQL Database.
$mysql_user = 'root'; // MySQL User.
$mysql_pwd = 'root'; // MySQL Password.
$mysql_table_prefix = 'Stats_'; // Stats prefix - Found in Stats plugin config.

$mc_server_ip = 'mcip.polardrafting.com'; // A CNAME or IP to your Minecraft server without the port.
$mc_server_port = '25595'; // Port Number to your Minecraft server.
$mc_server_disp_addr = 'mc.polardrafting.com'; // A 'nice' address for your Minecraft server. This will be the address that is displayed on the web interface.

$server_name = 'Mercury'; // Your Minecraft server name.
$fa_icon = 'plus'; // The FontAwesome icon you want to be next to your web end title. Use ending only. Ex: Icon you want to use "fa-bookmark-o" Just enter "bookmark-o".
$site_name = 'Fluid MC Stats'; // Name that will appear in page title and navbar.

$custom_links = array( // Links displayed in navbar and sidebar. Add as many as you need.
    "Develop Gravity" => "http://developgravity.com/",
    "Mojang" => "http://mojang.com/",
);

$icon_service_url = 'http://mctar.polardrafting.com/'; // URI for Avatars. Must follow domain.tld/playername/size. Leave as http://mctar.polardrafting.com/ for ours.

$players_per_page = '15'; // Number of players listed on each page.
$player_on_top = '5'; //Number of player on top list.

$custom_footer_text = '';

/**
 * Custom URL incase you want to use a different server for file hosting. Leave blank for using the same server.
 * To use, upload the img, font-awesome, bootstrap, css, js, and less directories to the server of your choice and put the URI to them below.
 * It is recommended not to delete these directories off of this server incase we forget to impliment this in some files.
 */
$custom_hosted_uri = '';

/**
 * Specify required time, in seconds, players need to be included in global stats generation.
 * Empty = 1 Hour.
 */
$required_global_stats_time = '3600'; // 1 Hour

/**
 * Specify Cache Time, in seconds, for supported pages. Leave blank to disable.
 */
$cache_time = '86400'; // 1 Day