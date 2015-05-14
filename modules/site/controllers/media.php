<?php

$media = WechatMedia::findByWechatId(isset($vars[1]) ? $vars[1] : 0);
if (is_null($media)) {
  dispatch('site/404');
  exit;
}

$showall = isset($_GET['showall']) ? true : false;

$page = isset($_GET['page']) && preg_match('/^\d+$/', $_GET['page']) ? $_GET['page'] : 1;
$entries_per_page = $settings['releases_per_page'];

$releases = WechatRelease::findAllWithPage($page, $entries_per_page, $media->getId());

$html = new HTML();

$html->renderOut('site/component/html_header', array(
  'title' => $media->getName() . " :: " . $settings['sitename'],
  'body_class' => 'releases'
));

$html->renderOut('site/component/mainnav');
$html->renderOut('site/component/jumbotron', array(
    'title' => $media->getName(),
    'bgcolor' => $media->getColor()
));
$html->renderOut('site/media', array(
    'media' => $media,
    'showall' => $showall,
    'releases' => $releases,
    'total' => ceil(WechatRelease::countAll($media->getId()) / $entries_per_page),
    'page' => $page
));
$html->renderOut('site/component/footer');

$html->renderOut('site/component/html_footer');