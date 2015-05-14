<!-- Fixed navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">折叠导航栏</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <h1><a class="navbar-brand" href="<?php echo uri('') ?>"><img src="<?php echo uri('modules/site/assets/images/logo.png', false) ?>" width="40" alt="<?php echo $settings['sitename'] ?> logo" />&nbsp;&nbsp;<?php echo $settings['sitename'] ?></a></h1>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo uri('') ?>">首页</a></li>
        <li><a href="<?php echo uri('contact') ?>">联系我们</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>