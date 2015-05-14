<div class="container" id="hello">
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-info">
        <?php $day = array('1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五', '6' => '六', '7' => '天'); ?>
        您好！今天是 <strong><?php echo date('Y年n月j日', time()) ?>, 星期<?php echo $day[date('N', time())] ?></strong>。 澳元汇率为<strong>1澳元=<span id="exchange">Loading...</span></strong>。 距离下个晚8点新闻更新还有 <strong><span id="countdown"></span></strong>
      </div>
    </div>
  </div>
</div>

<?php
$eight_stamp = is_over_eight() ? strtotime(date('Y-m-d '.$settings['time_to_refresh'].':00:00'))+24*60*60 : strtotime(date('Y-m-d '.$settings['time_to_refresh'].':00:00'));
$eight_stamp = $eight_stamp * 1000;

HTML::registerFooterLower('
<script type="text/javascript">
  // countdown
  refreshTimeOut();
  function refreshTimeOut() {
    $("#countdown").html(countdown( new Date('.$eight_stamp.') ).toString().replace(/hours?/g, "小时").replace(/minutes?/g, "分钟").replace(/seconds?/g, "秒").replace(/ |,/g, "").replace(/and/g, ""));
    setTimeout(refreshTimeOut, 1000);
  }
  
  // get exchange rate
  $.get("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22AUDCNY%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys", function(data){$("#exchange").html(data.query.results.rate.Rate+"元人民币");});
</script>
');
?>
