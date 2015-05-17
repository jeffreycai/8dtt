<?php
require_once "BaseWechatArticle.class.php";

class WechatArticle extends BaseWechatArticle {
  const STORY_IMAGE_WIDTH = 1300;
  const STORY_IMAGE_HEIGHT = 1300;
  const STORY_IMAGE_FONTSIZE = 36;
  const STORY_IMAGE_FONTSIZE_FOOTER = 24;
  const STORY_IMAGE_TEXTPADDING = 20;
  const STORY_IMAGE_TEXTLINEHEIGHT = 20;
  const THUMBNAIL_IMAGE_WIDTH = 430;
  const THUMBNAIL_IMAGE_HEIGHT = 185;
  
  public function makeThumbnail() {
    $release = $this->getWechatRelease();
    $file_name = date('Y_m_d-', $release->getPublishedAt()) . $this->getWechatRelease()->getWechatMediaId() . '-' . $release->getId() . '.jpg';
    $file_path = WECHAT_ARTICLE_THUMBNAIL_FOLDER . DS . $file_name;
    
    load_library_wide_image();
    $image = WideImage::load($this->getImage());
    $image = $image->resize(self::THUMBNAIL_IMAGE_WIDTH, self::THUMBNAIL_IMAGE_HEIGHT, 'outside');
    $image = $image->crop('center', 'center', self::THUMBNAIL_IMAGE_WIDTH, self::THUMBNAIL_IMAGE_HEIGHT);
    $image->saveToFile($file_path);
    
    $this->setThumbnail(str_replace(WEBROOT . "/", "", $file_path));
    $this->save();
  }
  
  public function getThumbnailUrl() {
    return uri($this->getThumbnail(), false);
  }
  
  public function getWechatRelease() {
    return WechatRelease::findById($this->getWechatReleaseId());
  }
  
  public function getWechatMedia() {
    return $this->getWechatRelease()->getWechatMedia();
  }
  
  public function getGotoUrl() {
    return uri('wechat-article/goto/'.$this->getId(), false);
  }
  
  public function getImageWithText() {
//    if (!empty($this->getDbFieldImage_with_text())) {
//      return $this->getDbFieldImage_with_text();
//    } else {
      return $this->make_image_with_text();
//    }
  }
  
  public function make_image_with_text() {
    $release = $this->getWechatRelease();
    $media = $release->getWechatMedia();
    $file_name = $media->getWechatId() . '-' . date('Y-m-d', $release->getPublishedAt()) . '.jpg';
    $save_path = WECHAT_ARTICLE_STORYIMAGE_FOLDER . "/$file_name";

    load_library_wide_image();
    $image = WideImage::load($this->getImage());
    $image = $image->resize(self::STORY_IMAGE_WIDTH, self::STORY_IMAGE_HEIGHT, 'inside');
    $this->addText($image, $media);
    $image->saveToFile($save_path);
    
    $uri = str_replace(WEBROOT . "/", "", $save_path);
    $this->setImageWithText($uri);
    $this->save();
    
    return $uri;
  }
  
  private function addText(&$image, &$media) {
 
    $char_per_line = floor((self::STORY_IMAGE_WIDTH - 2*self::STORY_IMAGE_TEXTPADDING) / self::STORY_IMAGE_FONTSIZE) - 9;
    
    $title_content = $this->getTitle() . "：";
    $title_line_num = ceil(mb_strlen($title_content, 'utf8') / $char_per_line);
    $digest_content = $this->getDigest() . " 。。。";
    $digest_line_num = ceil(mb_strlen($digest_content, 'utf8') / $char_per_line);
    
    

    
    $y = $image->getHeight();
    
    //// media title canvas
    $media_name_section_height = self::STORY_IMAGE_TEXTPADDING*3 + self::STORY_IMAGE_FONTSIZE + self::STORY_IMAGE_TEXTLINEHEIGHT*3;
    $image = $image->resizeCanvas($image->getWidth(), $y+$media_name_section_height, 0, 0, $image->allocateColor(r($media->getColor()),g($media->getColor()),b($media->getColor())));
    $canvas = $image->getCanvas();
    $canvas->useFont(MODULESROOT . "/site/assets/font.ttf", self::STORY_IMAGE_FONTSIZE, $image->allocateColor(255, 255, 255));
    $canvas->writeText(self::STORY_IMAGE_TEXTPADDING, $y+self::STORY_IMAGE_TEXTPADDING*3, $media->getName());
    $canvas->writeText($image->getWidth() - self::STORY_IMAGE_TEXTPADDING - 7*self::STORY_IMAGE_FONTSIZE, $y+self::STORY_IMAGE_TEXTPADDING*3, date('Y-m-d', $this->getWechatRelease()->getPublishedAt()));
    $y = $y + $media_name_section_height;
    
    //// content canvas
    $canvas_height = 
            self::STORY_IMAGE_TEXTPADDING +
            $title_line_num * self::STORY_IMAGE_FONTSIZE + // title
            ($title_line_num)*self::STORY_IMAGE_TEXTLINEHEIGHT +
            self::STORY_IMAGE_TEXTLINEHEIGHT +
            $digest_line_num * self::STORY_IMAGE_FONTSIZE + // digest
            ($digest_line_num)*self::STORY_IMAGE_TEXTLINEHEIGHT +
            self::STORY_IMAGE_TEXTPADDING;
    $image = $image->resizeCanvas($image->getWidth(), $y+$canvas_height, 0, 0, $image->allocateColor(0,0,0));
    $canvas = $image->getCanvas();
    $canvas->useFont(MODULESROOT . "/site/assets/font.ttf", self::STORY_IMAGE_FONTSIZE, $image->allocateColor(255, 255, 255));
    // title
    $y = $y + self::STORY_IMAGE_TEXTPADDING;
    for ($i = 0; $i < $title_line_num; $i++) {
      $canvas->writeText(self::STORY_IMAGE_TEXTPADDING, $y, mb_substr($title_content, $i*$char_per_line, $char_per_line, 'utf8'));
      $y = $y +self::STORY_IMAGE_FONTSIZE + self::STORY_IMAGE_TEXTPADDING;
    }
    $y = $y + + self::STORY_IMAGE_TEXTPADDING;
    // media
    for ($i = 0; $i < $digest_line_num; $i++) {
      $canvas->writeText(self::STORY_IMAGE_TEXTPADDING, $y, mb_substr($digest_content, $i*$char_per_line, $char_per_line, 'utf8'));
      $y = $y +self::STORY_IMAGE_FONTSIZE + self::STORY_IMAGE_TEXTPADDING;
    }
    
    //// goto canvase
    $got_canvase_height = 
            self::STORY_IMAGE_TEXTLINEHEIGHT*2 + 
            self::STORY_IMAGE_FONTSIZE_FOOTER +
            self::STORY_IMAGE_TEXTLINEHEIGHT*2;
    $image = $image->resizeCanvas($image->getWidth(), $y+$got_canvase_height, 0, 0, $image->allocateColor(255,255,255));
    $canvas = $image->getCanvas();
    $canvas->useFont(MODULESROOT . "/site/assets/font.ttf", self::STORY_IMAGE_FONTSIZE_FOOTER, $image->allocateColor(r($media->getColor()),g($media->getColor()),b($media->getColor())));
    $canvas->writeText(self::STORY_IMAGE_TEXTPADDING, $y+2*self::STORY_IMAGE_TEXTPADDING, '完整新闻请移步： http://www.8diantoutiao.com');
    
    return $image;
  }
}
