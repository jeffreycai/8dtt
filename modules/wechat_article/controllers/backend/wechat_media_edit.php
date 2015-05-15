<?php

$id = isset($vars[1]) ? $vars[1] : null;
$object = WechatMedia::findById($id);
if (is_null($object)) {
  HTML::forward('core/404');
}

// handle form submission
if (isset($_POST['submit'])) {
  $error_flag = false;

  /// validation
  
  // validation for $name
  $name = isset($_POST["name"]) ? strip_tags($_POST["name"]) : null;
  if (empty($name)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "name is required.", "zh" => "请填写name"))));
    $error_flag = true;
  }
  
  // validation for $wechat_id
  $wechat_id = isset($_POST["wechat_id"]) ? strip_tags($_POST["wechat_id"]) : null;
  if (empty($wechat_id)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "wechat_id is required.", "zh" => "请填写wechat_id"))));
    $error_flag = true;
  }
  
  // validation for $wechat_biz_id
  $wechat_biz_id = isset($_POST["wechat_biz_id"]) ? strip_tags($_POST["wechat_biz_id"]) : null;
  if (empty($wechat_biz_id)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "wechat_biz_id is required.", "zh" => "请填写wechat_biz_id"))));
    $error_flag = true;
  }
  
  // validation for $color
  $color = isset($_POST["color"]) ? strip_tags($_POST["color"]) : null;
  if (empty($color)) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "color is required.", "zh" => "请填写color"))));
    $error_flag = true;
  }

  if (strlen($color) >= 10) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Max length for color is 10", "zh" => "color 不能超过10个字符"))));
    $error_flag = true;
  }
  
  // validation for $weight
  $weight = isset($_POST["weight"]) ? strip_tags($_POST["weight"]) : null;  /// proceed submission
  
  // proceed for $name
  $object->setName($name);
  
  // proceed for $wechat_id
  $object->setWechatId($wechat_id);
  
  // proceed for $wechat_biz_id
  $object->setWechatBizId($wechat_biz_id);
  
  // proceed for $color
  $object->setColor($color);
  
  // proceed for $weight
  $object->setWeight($weight);
  if ($error_flag == false) {
    if ($object->save()) {
      Message::register(new Message(Message::SUCCESS, i18n(array("en" => "Record saved", "zh" => "记录保存成功"))));
      HTML::forwardBackToReferer();
    } else {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Record failed to save", "zh" => "记录保存失败"))));
    }
  }
}



$html = new HTML();

$html->renderOut('core/backend/html_header', array(
  'title' => i18n(array(
  'en' => 'Edit Wechat Media',
  'zh' => 'Edit 公众号',
  )),
));
$html->output('<div id="wrapper">');
$html->renderOut('core/backend/header');


$html->renderOut('wechat_article/backend/wechat_media_edit', array(
  'object' => $object
));


$html->output('</div>');

$html->renderOut('core/backend/html_footer');

exit;

