<?php
$date = isset($_GET['date']) ? strip_tags(trim($_GET['date'])) : null;

// get export articles when form is submitted
$articles = array();
if ($date) {
  $timestamp = strtotime($date);
  global $mysqli;
  $query = "SELECT * FROM wechat_release WHERE published_at > $timestamp AND published_at < " . ($timestamp + 24*60*60) . ' ORDER BY weight';
  $result = $mysqli->query($query);

  while($result && $r = $result->fetch_object()) {
    $release = new WechatRelease();
    DBObject::importQueryResultToDbObject($r, $release);
    $articles[] = $release->getTopStory();
  }
}

$html = new HTML();

$html->renderOut('core/backend/html_header', array(
  'title' => i18n(array(
  'en' => 'Export to Wechat',
  'zh' => '导出到微信',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('wechat_article/backend/wechat_media_export', array(
    'articles' => $articles
));


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;


