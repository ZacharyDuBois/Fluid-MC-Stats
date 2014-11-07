<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "live-ticker";
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
-->

<html>
  <head>
    <!-- Header -->
    <?php
    include 'inc/header.php';
    ?>
    <!-- /Header -->
    
    <style type="text/css">
      #live-ticker {
        font-weight: bold;
      }
      
      #live-ticker .old {
        color:       #ccc;
        font-weight: normal;
      }
    </style>
  </head>
  
  <body>
    <?php
    include 'inc/navbar.php';
    ?>
    
    <!-- Location -->
    <div class="container content-container">
      <div class="hidden-sm">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <ol class="breadcrumb">
              <li><a href="<?php echo LINKBASE; ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
              <li class="active"><i class="fa fa-list"></i> Player List</li>
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
              <h3 class="panel-title"><i class="fa fa-list"></i> Live Ticker</h3>
            </div>
            <div class="panel-body">
              <p>
                This is an automaticly reloaded page wich lists the newest activitys on the server.
              </p>
              
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Player</th>
                      <th>Action</th>
                    </tr>
                  </thead>
    
                  <tbody id='live-ticker'> <!-- ZACH NTS: Add in tooltips instead of abbr (don't forget to do it in player-list-search.js too then -->
                    <tr>
                      <td colspan="2">started listening to the live-ticker</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /Main Content -->
    
        <!-- Sidebar -->
        <div class="col-md-3 col-md-offset-1">
    
          <!-- Server status -->
          <?php
          include 'inc/serverstatusui.php';
          include 'inc/quicklinksui.php';
          ?>
          <!-- /Quick Links -->
    
        </div>
        <!-- /Sidebar -->
    
      </div>
      <!-- /Content -->
    
      <!-- Footer -->
      <?php
      include 'inc/footer.php';
      ?>
      <!-- /Footer -->
      <script type="text/javascript" src="<?php echo LINKBASE?>js/live-ticker.js"></script>
      <script type="text/javascript">
        liveticker.config.url = "//<?php echo $_SERVER["SERVER_NAME"].LINKBASE; ?>inc/ajax/live-ticker.php";
      </script>
    </div>
  </body>
</html>
