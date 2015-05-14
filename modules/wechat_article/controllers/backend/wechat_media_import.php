<?php

// handle form submission
if (isset($_POST['submit'])) {
  $code = $_POST['code'];
  // find biz_id
  $matches = array();
  preg_match('/__biz=(.+?)==/', $code, $matches);
  $biz_id = isset($matches[1]) ? $matches[1] : null;
  
  if ($media = WechatMedia::findByWechatBizId($biz_id)) {
    $last_release = WechatRelease::getLatestRelease($media->getId());
    $last_import_time = is_null($last_release) ? 0 : $last_release->getPublishedAt();
    $matches = array();
    preg_match("/msgList = '(.+)?';/", $code, $matches);
    if (isset($matches[1])) {
      $content = json_decode(html_entity_decode($matches[1]));
      if (isset($content->list) && is_array($content->list)) {
//  echo '<html><head><meta charset="utf-8"><body><pre>';
//  var_dump($content);;
//  echo "</pre></body></head></html>";
//  die();
        foreach ($content->list as $articles) {
          // only import when this article is published later than we last import
          if ($articles->comm_msg_info->datetime > $last_import_time) {
            $wechat_release = new WechatRelease();
            $wechat_release->setPublishedAt($articles->comm_msg_info->datetime);
            $wechat_release->setWechatMediaId($media->getId());
            $wechat_release->save();
            
            $wechat_article = new WechatArticle();
            $wechat_article->setIsTopStory(1);
            $wechat_article->setImage(clean_wechat_url($articles->app_msg_ext_info->cover));
            $wechat_article->setTitle($articles->app_msg_ext_info->title);
            $wechat_article->setDigest($articles->app_msg_ext_info->digest);
            $wechat_article->setUrl(clean_wechat_url($articles->app_msg_ext_info->content_url));
            $wechat_article->setWechatReleaseId($wechat_release->getId());
            $wechat_article->save();
            $wechat_article->makeThumbnail();
            
            $wechat_release->setTopStoryId($wechat_article->getId());
            $wechat_release->save();

            if ($articles->app_msg_ext_info->is_multi) {
              foreach ($articles->app_msg_ext_info->multi_app_msg_item_list as $article) {
                $wechat_article = new WechatArticle();
                $wechat_article->setImage(clean_wechat_url($article->cover));
                $wechat_article->setTitle($article->title);
                $wechat_article->setDigest($article->digest);
                $wechat_article->setUrl(clean_wechat_url($article->content_url));
                $wechat_article->setWechatReleaseId($wechat_release->getId());
                $wechat_article->save();
              }
            }
          } else {
            break;
          }
        }
        
        Message::register(new Message(Message::SUCCESS, 'Import successfully!'));
      } else {
        Message::register(new Message(Message::DANGER, 'Error: Match content format illegal.'));
      }
    } else {
      Message::register(new Message(Message::DANGER, 'Error: Can not match a pattern for content.'));
    }
  } else {
    Message::register(new Message(Message::DANGER, 'Error: Can not match a pattern for biz id.'));
  }
}



$html = new HTML();

$html->renderOut('core/backend/html_header', array(
  'title' => i18n(array(
  'en' => 'Import Wechat Media',
  'zh' => '导入公众号文章',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('wechat_article/backend/wechat_media_import');


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;


