<?php
require_once "BaseWechatMedia.class.php";

class WechatMedia extends BaseWechatMedia {
  static function findByWechatBizId($bzid, $instance = 'WechatMedia') {
    global $mysqli;
    $query = 'SELECT * FROM wechat_media WHERE wechat_biz_id=' . DBObject::prepare_val_for_sql($bzid);
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  static function findByWechatId($wid, $instance = 'WechatMedia') {
    global $mysqli;
    $query = 'SELECT * FROM wechat_media WHERE wechat_id=' . DBObject::prepare_val_for_sql($wid);
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  public function getLatestReleases($limit) {
    return WechatRelease::getLatestReleases($limit, $this->getId());
  }
}
