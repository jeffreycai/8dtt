<div id="page-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header"><?php i18n_echo(array(
        'en' => 'Wechat Media',
        'zh' => '公众号',
      )); ?></h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><?php i18n_echo(array(
            'en' => 'Import', 
            'zh' => '导入'
        )) ?></div>
        <div class="panel-body">
          
        <?php echo Message::renderMessages(); ?>
          
<form role="form" method="POST" action="<?php echo uri('admin/wechat_media/import') ?>">
  
<div class='form-group'>
  <label>请粘贴公众号历史页面源代码</label>
  <textarea class="form-control" name="code" rows="3" required></textarea>
</div>

  <input type="submit" name="submit" value="<?php i18n_echo(array(
      'en' => 'Import', 
      'zh' => '导入'
  )) ?>" class="btn btn-default">
</form>
          <br />
          <textarea class="form-control" rows="20">
<?php foreach (WechatMedia::findAll() as $media): ?>
<?php echo htmlentities($media->getName()) ?>:
http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=<?php echo $media->getWechatBizId() ?>==#wechat_redirect

<?php endforeach; ?>
          </textarea>
        </div>
      </div>
    </div>
  </div>
</div>

