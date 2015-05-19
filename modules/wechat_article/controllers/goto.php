<?php
$id = isset($vars[1]) ? $vars[1] : null;
$article = WechatArticle::findById($id);
if ($article) {
  $article->setClick($article->getClick() + 1);
  $article->save();
  
  
  $html = new HTML();
  $html->renderOut('wechat_article/goto', array(
      'article' => $article
  ));
  
  
//  HTML::forward($article->getUrl());
} else {
  HTML::forward('site/404');
}