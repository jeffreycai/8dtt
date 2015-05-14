<?php
function clean_wechat_url($url) {
  return str_replace('\/', '/', $url);
}

function r($hex) {
  $hex = ltrim($hex, "#");
  $hex = substr($hex, 0, 2);
  return hexdec($hex);
}

function g($hex) {
  $hex = ltrim($hex, "#");
  $hex = substr($hex, 2, 2);
  return hexdec($hex);
}

function b($hex) {
  $hex = ltrim($hex, "#");
  $hex = substr($hex, 4, 2);
  return hexdec($hex);
}