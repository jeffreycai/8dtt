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
            'en' => 'Create', 
            'zh' => '创建'
        )) ?></div>
        <div class="panel-body">
          
        <?php echo Message::renderMessages(); ?>
          
<form role="form" method="POST" action="<?php echo uri('admin/wechat_media/create') ?>">
  
<div class='form-group'>
  <label for='name'>name</label>
  <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['name']) ? strip_tags($_POST['name']) : '') : $object->getName()))) ?>' type='text' class='form-control' id='name' name='name' required />
</div>
  
<div class='form-group'>
  <label for='wechat_id'>wechat_id</label>
  <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['wechat_id']) ? strip_tags($_POST['wechat_id']) : '') : $object->getWechatId()))) ?>' type='text' class='form-control' id='wechat_id' name='wechat_id' required />
</div>
  
<div class='form-group'>
  <label for='wechat_biz_id'>wechat_biz_id</label>
  <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['wechat_biz_id']) ? strip_tags($_POST['wechat_biz_id']) : '') : $object->getWechatBizId()))) ?>' type='text' class='form-control' id='wechat_biz_id' name='wechat_biz_id' required />
</div>
  
<div class='form-group'>
  <label for='color'>color</label>
  <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['color']) ? strip_tags($_POST['color']) : '') : $object->getColor()))) ?>' type='text' class='form-control' id='color' name='color' required size=10 />
</div>
  
<div class='form-group'>
  <label for='weight'>weight</label>
  <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['weight']) ? strip_tags($_POST['weight']) : '') : $object->getWeight()))) ?>' type='text' class='form-control' id='weight' name='weight' />
</div>

  <input type="submit" name="submit" value="<?php i18n_echo(array(
      'en' => 'Create', 
      'zh' => '创建'
  )) ?>" class="btn btn-default">
</form>
          
        </div>
      </div>
    </div>
  </div>
</div>

