<?php
include_once MODULESROOT . DS . 'core' . DS . 'includes' . DS . 'classes' . DS . 'DBObject.class.php';

/**
 * DB fields
 * - id
 * - wechat_release_id
 * - title
 * - digest
 * - url
 * - image
 * - image_with_text
 * - thumbnail
 * - click
 * - is_top_story
 */
class BaseWechatArticle extends DBObject {
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
    $this->table_name = 'wechat_article';
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
   public function setWechatReleaseId($var) {
     $this->setDbFieldWechat_release_id($var);
   }
   public function getWechatReleaseId() {
     return $this->getDbFieldWechat_release_id();
   }
   public function setTitle($var) {
     $this->setDbFieldTitle($var);
   }
   public function getTitle() {
     return $this->getDbFieldTitle();
   }
   public function setDigest($var) {
     $this->setDbFieldDigest($var);
   }
   public function getDigest() {
     return $this->getDbFieldDigest();
   }
   public function setUrl($var) {
     $this->setDbFieldUrl($var);
   }
   public function getUrl() {
     return $this->getDbFieldUrl();
   }
   public function setImage($var) {
     $this->setDbFieldImage($var);
   }
   public function getImage() {
     return $this->getDbFieldImage();
   }
   public function setImageWithText($var) {
     $this->setDbFieldImage_with_text($var);
   }
   public function getImageWithText() {
     return $this->getDbFieldImage_with_text();
   }
   public function setThumbnail($var) {
     $this->setDbFieldThumbnail($var);
   }
   public function getThumbnail() {
     return $this->getDbFieldThumbnail();
   }
   public function setClick($var) {
     $this->setDbFieldClick($var);
   }
   public function getClick() {
     return $this->getDbFieldClick();
   }
   public function setIsTopStory($var) {
     $this->setDbFieldIs_top_story($var);
   }
   public function getIsTopStory() {
     return $this->getDbFieldIs_top_story();
   }

  
  
  /**
   * self functions
   */
  static function dropTable() {
    return parent::dropTableByName('wechat_article');
  }
  
  static function tableExist() {
    return parent::tableExistByName('wechat_article');
  }
  
  static function createTableIfNotExist() {
    global $mysqli;

    if (!self::tableExist()) {
      return $mysqli->query('
CREATE TABLE IF NOT EXISTS `wechat_article` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wechat_release_id` INT ,
  `title` VARCHAR(256) ,
  `digest` VARCHAR(1024) ,
  `url` VARCHAR(512) ,
  `image` VARCHAR(256) ,
  `image_with_text` VARCHAR(128) ,
  `thumbnail` VARCHAR(70) ,
  `click` INT DEFAULT 0 ,
  `is_top_story` TINYINT(1) DEFAULT 0 ,
  PRIMARY KEY (`id`)
 ,
INDEX `fk-wechat_article-wechat_release_id-idx` (`wechat_release_id` ASC),
CONSTRAINT `fk-wechat_article-wechat_release_id`
  FOREIGN KEY (`wechat_release_id`)
  REFERENCES `wechat_release` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
      ');
    }
    
    return true;
  }
  
  static function findById($id, $instance = 'WechatArticle') {
    global $mysqli;
    $query = 'SELECT * FROM wechat_article WHERE id=' . $id;
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
    $query = "SELECT * FROM wechat_article";
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatArticle();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function findAllWithPage($page, $entries_per_page) {
    global $mysqli;
    $query = "SELECT * FROM wechat_article LIMIT " . ($page - 1) * $entries_per_page . ", " . $entries_per_page;
    $result = $mysqli->query($query);
    
    $rtn = array();
    while ($result && $b = $result->fetch_object()) {
      $obj= new WechatArticle();
      DBObject::importQueryResultToDbObject($b, $obj);
      $rtn[] = $obj;
    }
    
    return $rtn;
  }
  
  static function countAll() {
    global $mysqli;
    $query = "SELECT COUNT(*) as 'count' FROM wechat_article";
    if ($result = $mysqli->query($query)) {
      return $result->fetch_object()->count;
    }
  }
  
  static function truncate() {
    global $mysqli;
    $query = "TRUNCATE TABLE wechat_article";
    return $mysqli->query($query);
  }
}