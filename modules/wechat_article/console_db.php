<?php
  //-- WechatMedia:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "wechat_article") {
      echo " - Drop table 'wechat_media' ";
      echo WechatMedia::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- WechatMedia:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "wechat_media") ) {
  //- create tables if not exits
  echo " - Create table 'wechat_media' ";
  echo WechatMedia::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  
  //-- WechatRelease:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "wechat_article") {
      echo " - Drop table 'wechat_release' ";
      echo WechatRelease::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- WechatRelease:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "wechat_release") ) {
  //- create tables if not exits
  echo " - Create table 'wechat_release' ";
  echo WechatRelease::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  
  //-- WechatArticle:Clear cache
  if ($command == "cc") {
    if ($arg1 == "all" || $arg1 == "wechat_article") {
      echo " - Drop table 'wechat_article' ";
      echo WechatArticle::dropTable() ? "success\n" : "fail\n";
    }
  }

  //-- WechatArticle:Import DB
  if ($command == "import" && $arg1 == "db" && (is_null($arg2) || $arg2 == "wechat_article") ) {
  //- create tables if not exits
  echo " - Create table 'wechat_article' ";
  echo WechatArticle::createTableIfNotExist() ? "success\n" : "fail\n";
  }
  