<?php

$showall = isset($_GET['showall']) ? true : false;


$html = new HTML();

$html->renderOut('site/component/html_header', array(
  'title' => $settings['sitename'] . " :: 每日晚8点准时更新澳洲微信公众号头条新闻",
  'body_class' => 'home'
));

$html->renderOut('site/component/mainnav');
$html->renderOut('site/component/hello');
$html->renderOut('site/index', array(
    'medias' => WechatMedia::findAll(),
    'showall' => $showall
));
$html->renderOut('site/component/footer');

$html->renderOut('site/component/html_footer');