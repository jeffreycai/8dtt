<ol>
  <?php
  $articles = $release ? $release->getArticles() : array();
  for ($i = 0; $i < sizeof($articles); $i++): $article = $articles[$i];
    ?>
    <?php if ($article->getIsTopStory()): ?>
      <li class="top-story">
        <a target="_blank" title="<?php echo str_replace('"', '\"', htmlentities($article->getTitle())) ?>" href="<?php echo $article->getGotoUrl() ?>"><img src="<?php echo $article->getThumbnailUrl() ?>" class="img-responsive" /><span><?php echo $article->getTitle(); ?></span></a>
          <?php else: ?>
      <li>
        <a target="_blank" title="<?php echo str_replace('"', '\"', htmlentities($article->getTitle())) ?>" href="<?php echo $article->getGotoUrl() ?>"><?php echo $i ?>. </a>
        <a target="_blank" title="<?php echo str_replace('"', '\"', htmlentities($article->getTitle())) ?>" href="<?php echo $article->getGotoUrl() ?>"><?php echo $article->getTitle() ?></a>
      <?php endif; ?>
    </li>
  <?php endfor; ?>
</ol>