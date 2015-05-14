<?php

$html = new HTML();

$html->renderOut('site/component/html_header', array(
  'title' => "联系我们",
  'body_class' => 'contact'
));

$html->renderOut('site/component/mainnav');
$html->renderOut('site/contact');
$html->renderOut('site/component/footer');

$html->renderOut('site/component/html_footer');

exit;