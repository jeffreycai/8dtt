<?php

require_once __DIR__ . '/../../../bootstrap.php';

$media = WechatMedia::findByWechatId('aozhoukid');
if ($media) {
  $media->delete();
  echo "success";
} else {
  echo "failed";
}
