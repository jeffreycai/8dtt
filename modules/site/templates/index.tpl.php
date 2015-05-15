<div class="container" id="body">
  <div class="row">
<?php foreach ($medias as $media): ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 news-list">
      <h2><a  style="color:<?php echo $media->getColor(); ?>" href="<?php echo uri('media/' . $media->getWechatId()) ?>"><?php echo $media->getName() ?></a></h2>
      <?php
        $releases = $media->getLatestReleases(5);
        $release;
        foreach ($releases as $r) {
          if (!is_over_eight() && $showall == false) {
            if ($r->getPublishedAt() < strtotime(date('Y-m-d'))) {
              $release = $r;
              break;
            }
            continue;
          } else {
            $release = $r;
            break;
          }
        }
        echo "<h3><span>".get_date($release->getPublishedAt())."</span></h3>";
        echo HTML::render('site/component/release_tile', array(
            'release' => $release
        ));
      ?>
      <p class="more"><small><a href="<?php echo uri('media/' . $media->getWechatId()) ?>"><span style="color:<?php echo $media->getColor(); ?>"><?php echo $media->getName() ?></span>过往文章 &raquo;</a></small></p>
    </div>
<?php endforeach; ?>

  </div>
</div>