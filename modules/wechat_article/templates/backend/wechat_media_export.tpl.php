<div id="page-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header"><?php i18n_echo(array(
        'en' => 'Export to wechat',
        'zh' => '导出到微信',
      )); ?></h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><?php i18n_echo(array(
            'en' => 'Wechat individual', 
            'zh' => '个人号'
        )) ?></div>
        <div class="panel-body">
          
        <?php echo Message::renderMessages(); ?>
          
<form role="form" method="GET" action="<?php echo uri('admin/wechat_media/export') ?>">
  
<div class='form-group'>
  <label>导出的文章日期 <small>Today is <?php echo date('Y-m-d') ?></small></label>
  <input class="form-control" type="text" name="date" required value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') ?>" />
</div>

  <input type="submit" name="submit" value="<?php i18n_echo(array(
      'en' => 'Export', 
      'zh' => '导出'
  )) ?>" class="btn btn-default">
</form>
          <br />
          <div class="row">
<?php foreach ($articles as $article): ?>
            <div class="col-xs-6 col-md-4">
              <img class="img-responsive" src="<?php echo uri($article->getImageWithText(), false); ?>" />
            </div>
<?php endforeach; ?>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <textarea class="form-control" rows="20">
点击阅读今日头条：
http://www.8diantoutiao.com

<?php foreach ($articles as $article): ?>
<?php echo htmlentities($article->getWechatMedia()->getName()) ?>:
---------------------------
<?php echo htmlentities($article->getTitle()) ?>:
<?php echo htmlentities($article->getDigest()) ?> ...

===========================

<?php endforeach; ?>
更多新闻请访问：http://www.8diantoutiao.com
              </textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

