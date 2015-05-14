<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - name
 * - wechat_id
 * - wechat_biz_id
 * - color
 */
class BaseWechatMedia extends DBObject {
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
    $this->table_name = 'wechat_media';
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
   public function setName($var) {
     $this->setDbFieldName($var);
   }
   public function getName() {
     return $this->getDbFieldName();
   }
   public function setWechatId($var) {
     $this->setDbFieldWechat_id($var);
   }
   public function getWechatId() {
     return $this->getDbFieldWechat_id();
   }
   public function setWechatBizId($var) {
     $this->setDbFieldWechat_biz_id($var);
   }
   public function getWechatBizId() {
     return $this->getDbFieldWechat_biz_id();
   }
   public function setColor($var) {
     $this->setDbFieldColor($var);
   }
   public function getColor() {
     return $this->getDbFieldColor();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('wechat_media');
  }
  
  static function tableExist() {
    return parent::tableExistByName('wechat_media');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `wechat_media` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(30) NOT NULL ,
  `wechat_id` VARCHAR(20) ,
  `wechat_biz_id` VARCHAR(20) ,
  `color` VARCHAR(7) ,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'WechatMedia') {
    global $mysqli;
    $query = 'SELECT * FROM wechat_media WHERE id=' . $id;
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
    $query = "SELECT * FROM wechat_media";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatMedia();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM wechat_media LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatMedia();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM wechat_media";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE wechat_media";
    return $mysqli->query($query);
  }
}