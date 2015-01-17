<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH . 'config.php';
include APPPATH . 'inc/version.php';
?>
<!-- Infobar -->
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="well well-sm">
      <p class="make-center">
        <?php
        if (!empty($custom_footer_text)) {
          echo $custom_footer_text;
        }
        ?>
        <i class="fa fa-info-circle"></i> Fluid MC Stats <?php echo $fmcs_version ?> is &copy; Copyright <a
            href="http://accountproductions.com/" title="AccountProductions">AccountProductions</a> and <a
            href="http://lolmewn.nl" title="Lolmewn&apos;s Website">Lolmewn</a>, 2014. All rights reserved.</p>
      <!-- DND: Keep this link here! This is copyrighted content -->
    </div>
  </div>
</div>
</div>
<!-- /Infobar -->

<!-- Map -->
<?php
if (!empty($map_url) and $map_bg == "true" and $navPage != "map") {
  ?>
  <!-- Block clicks -->
  <div class="bg-blocker"></div>
  <iframe class="bg-map" scrolling="no" allowtransparency="true" src="<?php echo $map_url; ?>" frameborder="0"></iframe>
<?php } ?>
<!-- /Map -->

<!-- SCRIPTS -->
<script src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>js/jquery-2.1.0.min.js"></script>
<script src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>js/jquery.timeago.js"></script>
<script type="text/javascript">
<?php if ($navPage == "search" or $navPage == "player-list") { ?>
    jQuery(document).ready(function () {
      jQuery("abbr.timeago").timeago();
    });
<?php } ?>
<?php if ($navPage == "live-ticker" or $navPage == 'player-list' or $navPage == 'search') { ?>
    var avatarURI = '<?php echo $avatar_service_uri; ?>';
    var installDir = '<?php echo LINKBASE; ?>';
<?php } ?>
  </script>
<?php if ($navPage == "search") { ?>
  <script src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>js/search-script.js"></script>
<?php } ?>
<?php if ($navPage == "player-list") { ?>
  <script src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>js/player-list-script.js"></script>
<?php } ?>
<?php if ($navPage == "live-ticker") { ?>
  <script src="<?php if ($custom_hosted_uri == '') { echo LINKBASE; } else { echo $custom_hosted_uri; } ?>js/live-ticker.js"></script>
<?php } ?>
<!-- /SCRIPTS -->

<!-- Analytic codes normally would be here. -->

<!-- /body would be here -->
