<?php
/* DB接続設定*/
function getDb(){
  $dsn = 'mysql:dbname='DBname'; host='host'; charset=utf8;';
  $usr = 'username';
  $passwd = 'password';

  try{
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }catch(PDOException $e){
    die("にゃーん:{$e->getMessage()}");
  }
  return $db;
}
