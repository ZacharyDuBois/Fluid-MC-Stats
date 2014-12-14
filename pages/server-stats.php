<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "server-stats";

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/db.php';
include_once APPPATH . 'inc/util.php';
include_once APPPATH . 'inc/queries.php';
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
-->

<html>
<head>
  <!-- Header -->
  <?php
  include APPPATH . 'inc/header.php';
  ?>
  <!-- /Header -->
</head>
<body>

<!-- Navbar -->
<?php
include APPPATH . "inc/navbar.php";
?>
<!-- /Navbar -->

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="<?php echo LINKBASE; ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><i class="fa fa-hdd-o"></i> Server Stats</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /Location -->

  <!-- Content -->
  <div class="row">
    <!-- Main Content -->
    <div class="col-md-6 col-md-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Stats</h3>
        </div>
        <div class="panel-body">
          <h3>Current Server Stats</h3>
          <hr>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <!-- TODO: Unit conversions + Plural wording & words. -->
              <thead>
              <tr>
                <th>Measurement</th>
                <th>Total</th>
                <th>Average</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th>Players</th>
                <td><?php
                  $amountOfPlayers = getAmountOfPlayers($mysqli, $mysql_table_prefix, $required_global_stats_time);
                  echo $amountOfPlayers ?> Players
                </td>
                <td></td>
              </tr>
              <tr>
                <th>Playtime</th>
                <?php
                if ($amountOfPlayers == 0) {
                  $amountOfPlayers = 1; //avoid division by 0, just divide by 1 instead lol
                }
                $value = getServerTotal($mysqli, $mysql_table_prefix, "playtime");
                echo "<td>" . convert_playtime($value) . "</td>";
                echo "<td>" . convert_playtime($value / $amountOfPlayers) . "</td>";
                ?>
              </tr>
              <tr>
                <th>Travel</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "move");
                echo "<td>" . round($value, 2) . " Meters</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Meters</td>";
                ?>
              </tr>
              <tr>
                <th>Blocks Broken</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "broken");
                echo "<td>" . $value . " Blocks</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Blocks</td>";
                ?>
              </tr>
              <tr>
                <th>Blocks Placed</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "placed");
                echo "<td>" . $value . " Blocks</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Blocks</td>";
                ?>
              </tr>
              <tr>
                <th>Deaths</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "death");
                echo "<td>" . $value . " Deaths</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Deaths</td>";
                ?>
              </tr>
              <tr>
                <th>Kills</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "kill");
                echo "<td>" . $value . " Kills</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Kills</td>";
                ?>
              </tr>
              <tr>
                <th>Arrows Fired</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "arrows");
                echo "<td>" . $value . " Arrows</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Arrows</td>";
                ?>
              </tr>
              <tr>
                <th>Collected EXP</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "exp");
                echo "<td>" . $value . " EXP</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " EXP</td>";
                ?>
              </tr>
              <tr>
                <th>Fish Caught</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "fish");
                echo "<td>" . $value . " Fish</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Fish</td>";
                ?>
              </tr>
              <tr>
                <th>Total Damage Taken</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "damage");
                echo "<td>" . $value . " Health</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Health</td>";
                ?>
              </tr>
              <tr>
                <th>Food Consumed</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "consumed");
                echo "<td>" . $value . " Foodz</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Foodz</td>";
                ?>
              </tr>
              <tr>
                <th>Crafted Items</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "crafted");
                echo "<td>" . $value . " Items</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Items</td>";
                ?>
              </tr>
              <tr>
                <th>Eggs Thrown</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "eggs");
                echo "<td>" . $value . " Eggs</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Eggs</td>";
                ?>
              </tr>
              <tr>
                <th>Tools Broken</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "toolsbroken");
                echo "<td>" . $value . " Tools</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Tools</td>";
                ?>
              </tr>
              <tr>
                <th>Commands</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "commands");
                echo "<td>" . $value . " Commands</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Commands</td>";
                ?>
              </tr>
              <tr>
                <th>Votes</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "votes");
                echo "<td>" . $value . " Votes</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Votes</td>";
                ?>
              </tr>
              <tr>
                <th>Items Dropped</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "dropped");
                echo "<td>" . $value . " Items</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Items</td>";
                ?>
              </tr>
              <tr>
                <th>Items Picked Up</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "pickedup");
                echo "<td>" . $value . " Items</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Items</td>";
                ?>
              </tr>
              <tr>
                <th>Teleports</th>
                <?php
                $value = getServerTotal($mysqli, $mysql_table_prefix, "teleport");
                echo "<td>" . $value . " Teleports</td>";
                echo "<td>" . round($value / $amountOfPlayers, 2) . " Teleports</td>";
                ?>
              </tr>
              </tbody>
            </table>
          </div>
          <!--<em>*Only includes data of players with more than 1 hour of playtime.</em>-->
        </div>
        <div class="panel-footer">
          <p><em>Please note that this only containts players with a time of more
                 than <?php echo convert_playtime("$required_global_stats_time"); ?></em></p>
        </div>
      </div>
    </div>
    <!-- /Main Content -->

    <!-- Sidebar -->
    <div class="col-md-3 col-md-offset-1">


      <!-- Server status -->
      <?php
      include APPPATH . 'inc/serverstatusui.php';

      include APPPATH . 'inc/quicklinksui.php';
      ?>
      <!-- /Quick Links -->

    </div>
    <!-- /Sidebar -->

  </div>
  <!-- /Content -->

  <!-- Footer -->
  <?php
  include APPPATH . 'inc/footer.php';
  ?>
  <!-- /Footer -->
</body>
</html>
