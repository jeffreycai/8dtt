<?php



// register admin
$user = User::getInstance();
if (is_backend() && $user->isLogin()) {
  Backend::registerSideNav(
  '
  <li>
    <a href="#"><i class="fa fa-folder-open"></i> '.i18n(array('en' => 'Wechat Media','zh' => '公众号',)).'<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
      <li><a href="'.uri('admin/wechat_media/list').'">'.i18n(array(
          'en' => 'List',
          'zh' => '列表'
      )).'</a></li>
      <li><a href="'.uri('admin/wechat_media/create').'">'.i18n(array(
          'en' => 'Create',
          'zh' => '创建'
      )).'</a></li>
      <li><a href="'.uri('admin/wechat_media/import').'">'.i18n(array(
          'en' => 'Import',
          'zh' => '导入'
      )).'</a></li>
    </ul>
  </li>
  '        
  );
  Backend::registerSideNav(
  '
  <li>
    <a href="'.uri('admin/wechat_media/export').'"><i class="fa fa fa-external-link"></i> '.i18n(array('en' => 'Wechat Export','zh' => '导出到微信',)).'</a>
  </li>
  '        
  );
}

// check thumbnail folder is writable
define('WECHAT_ARTICLE_THUMBNAIL_FOLDER', WEBROOT . '/files/wechat-article-thumbnails');
if (!is_dir(WECHAT_ARTICLE_THUMBNAIL_FOLDER)) {
  mkdir(WECHAT_ARTICLE_THUMBNAIL_FOLDER);
}
if (!is_writable(WECHAT_ARTICLE_THUMBNAIL_FOLDER)) {
  die('wechat-article-thumbnails folder needs to be writable');
}

// check image_with_text folder is writable
define('WECHAT_ARTICLE_STORYIMAGE_FOLDER', WEBROOT . '/files/wechat-article-storyimage');
if (!is_dir(WECHAT_ARTICLE_STORYIMAGE_FOLDER)) {
  mkdir(WECHAT_ARTICLE_STORYIMAGE_FOLDER);
}
if (!is_writable(WECHAT_ARTICLE_STORYIMAGE_FOLDER)) {
  die('wechat-article-storyimage folder needs to be writable');
}