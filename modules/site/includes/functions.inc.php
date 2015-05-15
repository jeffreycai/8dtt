<?php
function is_over_eight($difference = 0) {
  $difference = $difference * 60; // differences to eight
  
  $settings = Vars::getSettings();
  return time() > strtotime(date('Y-m-d '.$settings['time_to_refresh'].':00:00')) + $difference;
}

function check_timestamp_publishable($timestamp) {
  $settings = Vars::getSettings();
  $today_eight = strtotime(date('Y-m-d '.$settings['time_to_refresh'].':00:00'));
  if (is_over_eight()) {
    return true;
  } else {
    if ($timestamp > strtotime(date('Y-m-d')) && $timestamp < $today_eight) {
      return false;
    }
  }
  return true;
}

function get_date($timestamp = false) {
  $timestamp = $timestamp ? $timestamp : time();
  $today = strtotime(date('Y-m-d'));
  $yesterday = $today - (24*60*60);
  $tomorrow = $today + (24*60*60);
  if ($timestamp > $today && $timestamp < $tomorrow) {
    return '今天';
  } else if ($timestamp > $yesterday && $timestamp < $today) {
    return '昨天';
  } else {
    return date('Y-m-d', $timestamp);
  }
}