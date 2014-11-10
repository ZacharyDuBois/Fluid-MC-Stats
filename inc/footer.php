<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH.'config.php';
include APPPATH.'version.php';
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
        <i class="fa fa-info-circle"></i> Fluid MC Stats <?php echo $fmcs_version ?> is &copy; Copyright <a href="http://accountproductions.com/" title="AccountProductions">AccountProductions</a> and <a href="http://lolmewn.nl"
                                                                                                                                                                                                           title="Lolmewn&apos;s Website">Lolmewn</a>,
        2014. All rights reserved.</p>
      <!--<p class="make-center">We love feedback, please <a href="http://accpro.ws/4tbNe" title="Feedback">give us some</a>!</p>--><!-- DND: Keep this link here! This is copyrighted content -->
    </div>
  </div>
</div>
</div>
<!-- /Infobar -->

<!-- SCRIPTS -->
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>js/jquery-2.1.0.min.js"></script>
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>js/d3.v3.min.js"></script>
<?php if ($navPage == "search") { ?>
  <script src="<?php if (!empty($custom_hosted_uri)) {
    echo($custom_hosted_uri);
  } elseif ($navPage != "home") {
    echo "../";
  } else {
    echo("");
  } ?>js/search-script.js"></script>
<?php } ?>
<?php if ($navPage == "player-list") { ?>
  <script src="<?php if (!empty($custom_hosted_uri)) {
    echo($custom_hosted_uri);
  } elseif ($navPage != "home") {
    echo "../";
  } else {
    echo("");
  } ?>js/player-list-script.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>js/jquery.timeago.js"></script>
<?php if ($navPage == "search" or $navPage == "player-list") { ?>
  <script type="text/javascript">
    jQuery(document).ready(function () {
      jQuery("abbr.timeago").timeago();
    });
  </script>
<?php } ?>
<!-- /SCRIPTS -->

<!-- Antilitic codes normally would be here. Gaug.es and Google Analytics -->

<!-- /body would be here -->
