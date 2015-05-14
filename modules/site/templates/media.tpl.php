<div class="container" id="body">
  <div class="row">
    <div class="col-xs-12">
      <ol class="breadcrumb">
        <li><a href="<?php echo uri('') ?>">首页</a></li>
        <li class="active"><?php echo $media->getName() ?></li>
      </ol>
    </div>
  </div>
  <div class="row">
<?php foreach ($releases as $release):
  if (!is_over_eight() && $release->getPublishedAt() > strtotime(date('Y-m-d')) && !$showall) {
    continue;
  }
?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 news-list">
      <h3><span><?php echo get_date($release->getPublishedAt()) ?></span></h3>
      <?php
        echo HTML::render('site/component/release_tile', array(
            'release' => $release
        ));
      ?>
    </div>
<?php endforeach; ?>
  </div>
  <div class="row">
    <div class="col-xs-12" style="text-align: center;">
    <?php echo HTML::render('site/component/pagination', array(
        'total' => $total,
        'page' => $page,
        'range' => 1
    )) ?>
    </div>
  </div>
</div>