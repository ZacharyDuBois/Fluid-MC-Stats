<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <?php foreach ($MENULINKS as $link) : ?>
        <a href="<?php echo $link->getTarget(); ?>" title="<?php echo $link->getName(); ?>" class="list-group-item <?php if ($link->isActive($navPage) === TRUE) : ?>active<?php endif; ?>"><i class="fa <?php echo $link->getIcon(); ?>"></i> <?php echo $link->getName(); ?></a>
      <?php endforeach; ?>
    </div>
    <div class="list-group">
      <?php
      foreach ($custom_links as $key => $link) {
        echo "<a href='" . $link . "' title='" . $key . "' class='list-group-item'>" . $key . "</a>";
      }
      ?>
    </div>
  </div>
</div>
