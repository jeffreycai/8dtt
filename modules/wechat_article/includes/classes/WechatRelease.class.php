<?php
require_once "BaseWechatRelease.class.php";

class WechatRelease extends BaseWechatRelease {
  static function getLatestReleases($limit, $media_id) {
    global $mysqli;
    $query = "SELECT * FROM wechat_release WHERE wechat_media_id=$media_id ORDER BY published_at DESC LIMIT $limit";
    $result = $mysqli->query($query);
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj = new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    return $rtn;
  }
  
  static function getLatestRelease($media_id) {
    global $mysqli;
    $query = "SELECT * FROM wechat_release WHERE wechat_media_id=$media_id ORDER BY published_at DESC LIMIT 1";
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
  }
  
  static function findAll($media_id = null) {
    global $mysqli;
    $query = "SELECT * FROM wechat_release" . ($media_id ? " WHERE wechat_media_id=$media_id" : "");
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page, $media_id = null) {
    global $mysqli;
    $query = "SELECT * FROM wechat_release" . ($media_id ? " WHERE wechat_media_id=$media_id " : "") . " ORDER BY published_at DESC LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll($media_id = null) {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM wechat_release" . ($media_id ? " WHERE wechat_media_id=$media_id" : "");
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  public function getArticles() {
    global $mysqli;
    $query = "SELECT * FROM wechat_article WHERE wechat_release_id=" . $this->getId();
    $result = $mysqli->query($query);
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj = new WechatArticle();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    return $rtn;
  }
  
  public function getTopStory() {
    global $mysqli;
    $query = 'SELECT * FROM wechat_article WHERE id=' . $this->getTopStoryId();
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new WechatArticle();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  public function getWechatMedia() {
    return WechatMedia::findById($this->getWechatMediaId());
  }
}
