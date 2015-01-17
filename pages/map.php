<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "map";
if (empty($map_url)) {
  echo "<p style='color: #f00; padding: 20px;'>This feature is not enabled! Please enable it by editing the config!</p>";
  die();
}
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
<?php
include APPPATH . 'inc/navbar.php';
?>

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="<?php echo LINKBASE; ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><i class="fa fa-globe"></i> Map</li>
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
          <h3 class="panel-title"><i class="fa fa-globe"></i> Map</h3>
        </div>
        <div class="panel-body">
          <p>This page lets you look at the map of the server. Click <a href="<?php echo $map_url; ?>" title="Full Map">here</a>
             to see it in full screen.</p>
          <iframe class="map" scrolling="no" allowtransparency="true" src="<?php echo $map_url; ?>"
                  frameborder="0"></iframe>
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
</div>
</body>
</html>
