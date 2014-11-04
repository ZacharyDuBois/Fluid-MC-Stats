<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "top-lists";

include_once '../config.php';
include_once '../inc/db.php';
include_once '../inc/util.php';
include_once '../inc/queries.php';

$stats = array(
	'playtime',
	'exp',
	'placed',
	'broken',
	'crafted',
	'toolsbroken',
	'pickedup',
	'dropped',
);

?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
-->

<html>
<head>
  <!-- Header -->
  <?php
  include '../inc/header.php';
  ?>
  <!-- /Header -->
</head>
<body>

<!-- Navbar -->
<?php
include '../inc/navbar.php';
?>
<!-- /Navbar -->

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="../index.php" title="Home"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><i class="fa fa-bar-chart-o"></i> Top Players</li>
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
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Top Players</h3>
				</div>
				
				<div class="panel-body">
					<p>These are users with current top rankings on the server.</p>
					<?php foreach ($stats as $key => $stat) : ?>
						<?php if ($key % 2 === 0) : ?>
							<div class="row">
						<?php endif; ?>
						
						<div class="table-responsive col-xs-12 col-sm-6">
							<table class="table table-hover table-striped table-bordered">
							<!-- TODO: Unit conversions + Plural wording & words. -->
							<thead>
								<tr>
									<th>Rank</th>
									<th>Player</th>
									<th><?php echo getHumanFriendlyStatName($stat); ?>
								</tr>
							</thead>
							
							<tbody>
								<?php
									$page = 1;
									$result = getTopPlayers($mysqli, $mysql_table_prefix, $stat, $page);
									$i = 1 * $page;
									
									if (!$result) {
										echo $mysqli->error;
									}
									
									while (($arr = $result->fetch_array()) != null) {
										echo "<tr>";
										echo "<th>&num;" . $i++ . "</th>";
										$playerName = getPlayerName($mysqli, $mysql_table_prefix, $arr['player_id']);
										echo "<td><img src='" . $avatar_service_uri . $playerName . "/16' "
										. "class='img-circle avatar-list-icon'> <a href='player.php?id="
										. $arr['player_id'] . "' title='" . $playerName . "&apos;s Stats'> " . $playerName . "</a></td>";
										echo "<td>" . translateValue($stat, $arr['value']) . "</td>";
									}
								?>
							</tbody>
							</table>
						</div>
						
						<?php if ($key % 2 === 1) : ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					
					<?php if ($key % 2 === 0) : ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- /Main Content -->
		
		<!-- Sidebar -->
		<div class="col-md-3 col-md-offset-1">
			<!-- Server status -->
			<?php
				include '../inc/serverstatusui.php';
				include '../inc/quicklinksui.php';
			?>
			<!-- /Quick Links -->
		</div>
		<!-- /Sidebar -->
	</div>
  <!-- /Content -->

  <!-- Footer -->
  <?php
  include '../inc/footer.php';
  ?>
  <!-- /Footer -->
</body>
</html>
