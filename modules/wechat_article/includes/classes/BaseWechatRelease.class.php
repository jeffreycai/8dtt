<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - wechat_media_id
 * - published_at
 * - top_story_id
 */
class BaseWechatRelease extends DBObject {
  /**
   * Implement parent abstract functions
   */
  protected function setPrimaryKeyName() {
    $this->primary_key = array(
      'id'
    );
  }
  protected function setPrimaryKeyAutoIncreased() {
    $this->pk_auto_increased = TRUE;
  }
  protected function setTableName() {
    $this->table_name = 'wechat_release';
  }
  
  /**
   * Setters and getters
   */
   public function setId($var) {
     $this->setDbFieldId($var);
   }
   public function getId() {
     return $this->getDbFieldId();
   }
   public function setWechatMediaId($var) {
     $this->setDbFieldWechat_media_id($var);
   }
   public function getWechatMediaId() {
     return $this->getDbFieldWechat_media_id();
   }
   public function setPublishedAt($var) {
     $this->setDbFieldPublished_at($var);
   }
   public function getPublishedAt() {
     return $this->getDbFieldPublished_at();
   }
   public function setTopStoryId($var) {
     $this->setDbFieldTop_story_id($var);
   }
   public function getTopStoryId() {
     return $this->getDbFieldTop_story_id();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('wechat_release');
  }
  
  static function tableExist() {
    return parent::tableExistByName('wechat_release');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `wechat_release` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wechat_media_id` INT ,
  `published_at` INT ,
  `top_story_id` INT ,
  PRIMARY KEY (`id`)
 ,
INDEX `fk-wechat_release-wechat_media_id-idx` (`wechat_media_id` ASC),
CONSTRAINT `fk-wechat_release-wechat_media_id`
  FOREIGN KEY (`wechat_media_id`)
  REFERENCES `wechat_media` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'WechatRelease') {
    global $mysqli;
    $query = 'SELECT * FROM wechat_release WHERE id=' . $id;
    $result = $mysqli->query($query);
    if ($result && $b = $result->fetch_object()) {
      $obj = new $instance();
      DBObject::importQueryResultToDbObject($b, $obj);
      return $obj;
    }
    return null;
  }
  
  static function findAll() {
    global $mysqli;
    $query = "SELECT * FROM wechat_release";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM wechat_release LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatRelease();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM wechat_release";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE wechat_release";
    return $mysqli->query($query);
  }
}