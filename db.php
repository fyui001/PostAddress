<?php
/* DB接続設定*/
function getDb(){
  $dsn = 'mysql:dbname=JapanAddress; host=192.168.33.10; charset=utf8;';
  $usr = 'root';
  $passwd = 'hogehoge';

  try{
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }catch(PDOException $e){
    die("にゃーん:{$e->getMessage()}");
  }
  return $db;
}
