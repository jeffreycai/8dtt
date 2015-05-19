<!DOCTYPE html>
<html lang="zh" dir="ltr">

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!--<meta http-equiv="refresh" content="1; url=<?php echo $article->getUrl() ?>" />-->

  <title><?php echo $article->getTitle() ?> :: <?php echo $settings['sitename'] ?></title>

</head>

<body class="home">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63021338-1', 'auto');
  ga('send', 'pageview', {
    'hitCallback': function() {
      window.location = "<?php echo $article->getUrl() ?>";
    }
  });
</script>


<noscript>
<h1><?php echo $article->getTitle() ?></h1>
<p>
<?php echo $article->getDigest(); ?>
</p>
<p>
  <a href="<?php echo $article->getUrl() ?>">查看完整文章</a>
</p>
</noscript>

</body>
</html>