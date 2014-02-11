<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->

<html>
    <head>
        <title>Fluid MC Stats - Install</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../css/custom.css">
        <!-- TODO: Keep file locations relative so the install will work properly (and look properly). -->
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Mobile -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="install.html"><i class="fa fa-plus"></i> Fluid MC Stats</a>
            </div>
            <!-- /Mobile -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="install.html"><i class="fa fa-wrench"></i> Install &amp; Configure</a></li>
                    <li><a href="http://developgravity.com/">DevelopGravity</a></li>
                    <li><a href="http://lolmewn.nl/">Lolmewn</a></li>
                </ul>
            </div>
        </nav>
        <!-- /Navbar -->

        <!-- Content -->
        <div class="container content-container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-wrench"></i> Install &amp; Configure</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning"><strong><i class="fa fa-exclamation-circle"></i> Warning:</strong> Please take a backup
                            of everything before connecting you're database. Also note, this is pre-alpha software. You cannot complain about it.
                            If you don't like it, open a issue and we may try and fix it.
                        </div>
                        <?php
                        $faultFound = false;
                        if (file_exists("../../config.php")) {
                            //file exists, check if writable
                            if (!is_writable("../../config.php")) {
                                $faultFound = true;
                                ?>
                                <div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>
                                        Configuration Warning:</strong> config.php is not writable in <?php echo realpath("../../config.php"); ?>. <br/>
                                    Please use command <code>chmod 666 <?php echo realpath("../../config.php"); ?></code> to make the file
                                    writable.
                                </div>
                                <?php
                            }
                        } else {
                            $faultFound = true;
                            ?>
                            <div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>
                                    Configuration Warning:</strong> config.php is not found in <?php echo realpath("../../config.php"); ?>. Please
                                make
                                sure the file exists and has not been deleted.
                            </div>
                            <?php
                        }
                        if ($faultFound) {
                            ?>
                            <div class="jumbotron">
                                <h1>Welcome!</h1>

                                <p>to Fluid MC Stats! To get started, please fix the issues in red above first.</p>
                                <a href="install.php">
                                    <button class="btn btn-primary">Reassess</button>
                                </a>
                            </div>
                            <?php
                        } else {
                            $configFile = fopen("../../config.php", $mode)
                            ?>
                            <div class="jumbotron">
                                <h1>Welcome!</h1>

                                <p>to Fluid MC Stats! Get started by filling out the configuration information below and then click Install!</p>
                                <p>If you are seeing this, then the config tests have passed and you may now configure!</p>
                            </div>
                            <h1><i class="fa fa-gear"></i> Configuration</h1>

                            <p>All items marked with a star are required items. Please fill them out.</p>

                            <div class="well well-lg">
                                <form class="form-horizontal" role="form" autocomplete="off" id="install-form">
                                    <h4><i class="fa fa-hdd-o"></i> Database</h4>

                                    <p>Enter the database details to your the MySQL server where your stats data is stored. Please note that the user only
                                        needs SELECT permissions on the Stats database.</p>

                                    <div class="form-group">
                                        <label for="mySQLHost" class="col-sm-3 control-label">Host&ast;</label>

                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input name="mysql_host" type="text" class="form-control" id="mySQLHost" placeholder="Hostname" needed>
                                                <span class="input-group-addon">&colon;</span>
                                            </div>
                                            <span class="help-block">
                                                This is the hostname or IP of where your MySQL database is located.
                                            </span>
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="mysql_port" type="text" class="form-control" id="mySQLHostPort" placeholder="3306" needed>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mySQLDatabaseName" class="col-sm-3 control-label">Database&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="mysql_database" type="text" class="form-control" id="mySQLDatabaseName" placeholder="Stats" needed>
                                            <span class="help-block">
                                                This is the Stats database name.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mySQLDatabasePrefix" class="col-sm-3 control-label">Database Prefix&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="mysql_table_prefix" type="text" class="form-control" id="mySQLDatabasePrefix" placeholder="Stats_" needed>
                                            <span class="help-block">
                                                This is the prefix for the stats tables in your database. The default is <code>Stats_</code>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mySQLUser" class="col-sm-3 control-label">User&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="mysql_user" type="text" class="form-control" id="mySQLUser" placeholder="stats" needed>
                                            <span class="help-block">
                                                The MySQL user for your database. This user only needs SELECT permissions of the database.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mySQLPassword" class="col-sm-3 control-label">Password&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="mysql_pwd" type="password" class="form-control" id="mySQLPassword" placeholder="Password" needed>
                                            <span class="help-block">
                                                The password for your MySQL user.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3">
                                            <a href="javascript:void(0)">
                                                <button class="btn btn-primary btn-lg" id="mysql-test">Test credentials</button>
                                            </a>

                                            <div id="mysql-result"></div>
                                        </div>
                                    </div>
                                    <h4><i class="fa fa-terminal"></i> Minecraft Server Settings</h4>

                                    <p>Enter your Minecraft server details below.</p>

                                    <div class="form-group">
                                        <label for="mcName" class="col-sm-3 control-label">Server Name&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="server_name" type="text" class="form-control" id="mcName" placeholder="My Amazing Server" needed>
                                            <span class="help-block">
                                                What you call your server.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mcResolveAddr" class="col-sm-3 control-label">Resolvable Address&ast;</label>

                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input name="mc_server_ip" type="text" class="form-control" id="mcResolveAddr" placeholder="play.example.com" needed>
                                                <span class="input-group-addon">&colon;</span>
                                            </div>
                                            <span class="help-block">
                                                This is an address that you can connect with. It must be a A, AAAA, CNAME, or IP.
                                            </span>
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="mc_server_port" type="text" class="form-control" id="mcResolveAddrPort" placeholder="25565" needed>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mcDispAddr" class="col-sm-3 control-label">Display Address</label>

                                        <div class="col-sm-9">
                                            <input name="mc_server_disp_addr" type="text" class="form-control" id="mcDispAddr" placeholder="play.example.com">
                                            <span class="help-block">
                                                This is the address you would like people to connect with. It will be displayed on the interface.
                                            </span>
                                        </div>
                                    </div>
                                    <h4><i class="fa fa-globe"></i> Fluid MC Stats Interface Settings</h4>

                                    <p>These are the settings that directly change items on the entire interface.</p>

                                    <div class="form-group">
                                        <label for="fmcsSiteName" class="col-sm-3 control-label">Site Name&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="site_name" type="text" class="form-control" id="fmcsSiteName" placeholder="My Awesome Server Stats" needed>
                                            <span class="help-block">
                                                What do you want the stats interface to be called? This will appear in the menu bar and other places.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsIcon" class="col-sm-3 control-label">Site Icon</label>

                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">fa&dash;</span>
                                                <input name="fa_icon" type="text" class="form-control" id="fmcsIcon" placeholder="plus">
                                            </div>
                                            <span class="help-block">
                                                A suffix for a <a href="http://fontawesome.io">Font
                                                    Awesome</a> icon. Like <code>fa-lemon-o</code> would be <code>lemon-o</code>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsPPP" class="col-sm-3 control-label">Players Per Page&ast;</label>

                                        <div class="col-sm-9">
                                            <select name="player_per_page" class="form-control" id="fmcsPPP" needed>
                                                <option value="5">5 (Min)</option>
                                                <option value="10">10</option>
                                                <option value="15" selected>15 (Recommended)</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30 (Max)</option>
                                            </select>
                                            <span class="help-block">
                                                The number of players to a page that you want display. Slower web-server should have this set lower. Faster ones can have it higher.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsCalcTop" class="col-sm-3 control-label">Calculate Top Players Using&ast;</label>

                                        <div class="col-sm-9">
                                            <select name="" class="form-control" id="fmcsCalcTop" needed>
                                                <option value="playtime" selected>Playtime</option>
                                                <option value="broken">Blocks Broken</option>
                                                <option value="placed">Blocks Placed</option>
                                                <option value="deaths">Deaths</option>
                                                <option value="kills">Kills</option>
                                                <option value="arrows">Arrows Fired</option>
                                                <option value="exp">Collected EXP</option>
                                                <option value="fish">Fish Cought</option>
                                                <option value="damage">Total Damage Taken</option>
                                                <option value="consumed">Food Consumed</option>
                                                <option value="crafted">Crafted Items</option>
                                                <option value="eggs">Eggs Thrown</option>
                                                <option value="toolsbroken">Tools Broken</option>
                                                <option value="commands">Commands</option>
                                                <option value="votes">Votes</option>
                                                <option value="dropped">Items Dropped</option>
                                                <option value="pickedup">Items Picked Up</option>
                                                <option value="teleport">Teleports</option>
                                            </select>
                                            <span class="help-block">
                                                Some text you want to include next to the footer text. Keep it short as it looks better when it doesn't need to wrap lines.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsNoTP" class="col-sm-3 control-label">Number Of Top Players&ast;</label>

                                        <div class="col-sm-9">
                                            <select name="player_on_top" class="form-control" id="fmcsNoTP" needed>
                                                <option value="1">1 (Min)</option>
                                                <option value="3">3</option>
                                                <option value="5">5</option>
                                                <option value="10" selected>10 (Max, Default)</option>
                                            </select>
                                            <span class="help-block">
                                                The number of players you want to be considered to be &apos;top&apos; players. These will be displayed on the <em>Top
                                                    Players</em> page.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsFooterTxt" class="col-sm-3 control-label">Additional Footer Text</label>

                                        <div class="col-sm-9">
                                            <input name="custom_footer_text" type="text" class="form-control" id="fmcsFooterTxt" placeholder="Some random cool footer text &colon;)">
                                            <span class="help-block">
                                                Some text you want to include next to the footer text. Keep it short as it looks better when it doesn't need to wrap lines.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsLink1Name" class="col-sm-3 control-label">Custom Link 1</label>

                                        <div class="col-sm-3">
                                            <input name="customname1" type="text" class="form-control" id="fmcsLink1Name" placeholder="DevelopGravity">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="customvalue1" type="text" class="form-control" id="fmcsLink1URL" placeholder="http&colon;//developgravity.com/">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsLink2Name" class="col-sm-3 control-label">Custom Link 2</label>

                                        <div class="col-sm-3">
                                            <input name="customname2" type="text" class="form-control" id="fmcsLink2Name" placeholder="Lolmewn">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="customvalue2" type="text" class="form-control" id="fmcsLink2URL" placeholder="http&colon;//lolmewn.nl/">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsLink3Name" class="col-sm-3 control-label">Custom Link 3</label>

                                        <div class="col-sm-3">
                                            <input name="customname3" type="text" class="form-control" id="fmcsLink3Name" placeholder="Mojang">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="customvalue3" type="text" class="form-control" id="fmcsLink3URL" placeholder="http&colon;//mojang.com/">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsLink4Name" class="col-sm-3 control-label">Custom Link 4</label>

                                        <div class="col-sm-3">
                                            <input name="customname4" type="text" class="form-control" id="fmcsLink4Name" placeholder="Example 4">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="customvalue4" type="text" class="form-control" id="fmcsLink4URL" placeholder="http&colon;//example.com/">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsLink5Name" class="col-sm-3 control-label">Custom Link 5</label>

                                        <div class="col-sm-3">
                                            <input name="customname5" type="text" class="form-control" id="fmcsLink5Name" placeholder="Example 5">
                                        </div>
                                        <div class="col-sm-6">
                                            <input name="customvalue5" type="text" class="form-control" id="fmcsLink5URL" placeholder="http&colon;//example.com/">
                                        </div>
                                    </div>
                                    <h4><i class="fa fa-lock"></i> Fluid MC Stats Advanced Settings</h4>

                                    <p>These settings are for advanced users only. Please leave them alone if you do not know what they do.</p>

                                    <div class="form-group">
                                        <label for="fmcsSiteName" class="col-sm-3 control-label">File CDN URI</label>

                                        <div class="col-sm-9">
                                            <input name="custom_hosted_uri" type="text" class="form-control" id="fmcsAdvCDN" placeholder="http&colon;//static.example.com/">
                                            <span class="help-block">
                                                This is for support for hosting static files externally. To use, upload the bootstrap, css, fontawesome, img, and
                                                js directories to a remote web-server/CDN and put the path to all of them below.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsAdvGlobalNeededTime" class="col-sm-3 control-label">Required Global Stats Player Include
                                            Time&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="required_global_stats_time" type="text" class="form-control" id="fmcsAdvGlobalNeededTime" placeholder="3600" value="3600">
                                            <span class="help-block">
                                                This is how long a player has to play for (in seconds) to be included in the server stats data. Defaults to 1 hour.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsAdvCacheTime" class="col-sm-3 control-label">Cache Time&ast;</label>

                                        <div class="col-sm-9">
                                            <input name="cache_time" type="text" class="form-control" id="fmcsAdvCacheTime" placeholder="1800" value="1800">
                                            <span class="help-block">
                                                The amount of time supported pages are cached. Single player pages will not be cached. Defaults to 30 minutes.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmcsAdvAvatarService" class="col-sm-3 control-label">Avatar Service URI&ast;</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fmcsAdvAvatarService"
                                                   placeholder="http&colon;//mc-avatar.developgravity.com/" value="http://mc-avatar.developgravity.com/">
                                            <span class="help-block">
                                                The URI for the avatar service you want to use. The URI must follow <code>http://domain.tld/directory/playername/pixelsize</code>.
                                                Known supported are <code>http://mc-avatar.developgravity.com/</code> and <code>https://minotar.net/avatar/</code>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-lg btn-block btn-success" id="install-button">
                                                <i class="fa fa-check-circle-o"></i> Install
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="panel-footer"><i class="fa fa-info-circle"></i> Fluid MC Stats v0.0.1 Pre-Alpha is &copy; Copyright <a
                            href="http://accountproductions.com/">AccountProductions</a> and <a href="http://lolmewn.nl">Lolmewn</a>, 2014. All rights
                        reserved.
                        <!-- DND: Keep this link here! This is copyrighted content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- TODO: Keep file locations relative so the install will work properly (and look properly). -->
        <script src="../../js/jquery-2.1.0.min.js"></script>
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../js/d3.v3.min.js"></script>
        <script src="../../js/install/credentials-test.js"></script>
        <script src="../../js/install/install.js"></script>
    </body>
</html>
