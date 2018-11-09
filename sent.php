<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

function isAjax(){
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    return true;
  }else{
    return false;
  }
}

/* データベース設定の読み込み */
require_once('db.php');

/* 関数定義 */
function search($PostNum){
  try{
    $db = getDb();
    $Message = '';
    $Status = true;
    //SQL文 :idは、名前付きブレースホルダ
    $sql = "select Prefecture, City, Town from PostAddress where PostNum = '{$PostNum}'";
    $stt = $db->prepare($sql);
    $stt->execute(); //実行
    $data = $stt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($data)){
      $Status = false;
      $Message = 'この郵便番号は有効ではありません。';
    }
    $db = null;
  }catch(PDOException $e){
    die("んなぁ...　残酷だなぁ...:{$e->getMessage()}");
  }

  if(!$Status){
    return array('Status' => $Status, 'Message' => $Message);
  }else{
    return array( 'Status' => $Status, 'address' => $data);
  }
}

  /* POST確認 */
if(empty($_POST['PostNum'])){
  $success = array('Status' => false, 'Message' => '郵便番号を入力してください。');
}else{
$PostNum = $_POST['PostNum'];
//ハイフン無視
$PostNum = str_replace(array('-', 'ー'), '', $PostNum);
$success = search($PostNum);
}

if(isAjax()){
  echo json_encode($success);
  exit();
}
