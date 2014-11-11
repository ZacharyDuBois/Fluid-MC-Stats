<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH.'config.php';
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

  <!-- Mobile -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo LINKBASE; ?>" title="Home"><i class="fa <?php echo $fa_icon; ?>"></i> <?php echo $site_name; ?></a>
  </div>
  <!-- /Mobile -->

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <?php foreach ($MENULINKS as $link) : ?>
        <li <?php if ($link->isActive($navPage) === TRUE) : ?>class="active"<?php endif; ?>>
          <?php echo $link; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <form class="navbar-form navbar-right" role="search" action="<?php echo LINKBASE; ?>search">
      <div class="form-group">
        <input name="name" type="text" class="form-control" placeholder="Player Name">
      </div>
      <button type="submit" class="btn btn-default">Find <i class="fa fa-search"></i></button>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-link"></i> Links <b
              class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php
          if (empty($custom_links)) {
            echo "No links here!";
          }
          foreach ($custom_links as $key => $link) {
            echo "<li><a href='" . $link . "' title='" . $key . "'>" . $key . "</a></li>";
          }
          ?>
        </ul>
      </li>
    </ul>
  </div>
</nav>
