<?php
  //////////////////////////////////////////////////////////////////
  //便利な関数
  //////////////////////////////////////////////////////////////////
 
  /**
  *  HTMLエンティティにエスケープ
  *
  *@param string | null $text
  *@return string 
  */
 function html_escapse($text)
 {
  //テキストがnullの場合は、空の文字列を返却
  if($text === null){
    $text = '';
  }
   // ENT_QUOTESを指定することで、これらの特殊文字を安全にエンコードし、XSS攻撃のリスクを軽減
   return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
  }

  /**
   * 画像ファイル名から画像のURLを生成
   * 
   * @param string|null  $name　画像ファイル名
   * @param string $type ユーザー画像（user）からツイート画像（tweet）
   * @return string
   */

  function buildImagePath(string $name = null, string $type)
  {
    if ($type === 'user' && !isset($name)){
      return HOME_URL . 'Views/img/icon-default-user.svg';
    }
      return HOME_URL . 'Views/img_uploaded/' . $type . '/' . html_escapse($name);
  }

  /**
 * 指定した日時からどれだけ経過したかを取得
 *
 * @param string $datetime
 * @return string
 */
function convertToDayTimeAgo(string $datetime)
{
  // 引数の日時かUNIXタイムに変換
  //UNIXタイムは、1970年1月1日からの経過秒数
  //これに変換することにより計算しやすくなる
  $unix = strtotime($datetime);

  //現在の日時をUNIXタイムで取得
  $now = time();

  //現在時刻から引数の時刻を引いて差分の秒数を取得
  $diff_sec = $now - $unix;
  if ($diff_sec < 60){
    //60秒未満の場合
    $time =$diff_sec;
    $unit = '秒前';

  }elseif($diff_sec < 3600){
    //60分未満の場合
    $time = $diff_sec/60;
    $unit = '分前';

   } elseif($diff_sec < 86400){
    //24時間未満の場合
    $time = $diff_sec/3600;
    $unit = '時間前';

   } elseif($diff_sec < 2764800){
    //32日未満の場合
    $time = $diff_sec/86400;
    $unit = '日前';

   }else {
  if(date('Y') === date('Y', $unix)){
    //同じ年
    $time = date('n月j日', $unix); 
  }else {
    //過去の年
    $time = date('Y年n月j日', $unix);
  }
  return $time;
  }
  //intの型キャストを整数で返却
  //unitは単位
  return (int)$time . $unit;
}

/**
 * ユーザー情報をセッションに保存
 * 
 * @param array $user
 * @return void
 */
function saveUserSession(array $user)
{
  //セッションを開始していない場合
  if(session_status() === PHP_SESSION_NONE){
    //セッションを開始
    session_start();
  }
  $_SESSION['USER'] = $user;
}
/**
 * ユーザー情報をセッションにから削除
 * 
 * @param array $user
 * @return void
 */
function deleteUserSession()
{
  //セッションを開始していない場合
  if(session_status() === PHP_SESSION_NONE){
    //セッション開始
    session_start();
  }
  unset($_SESSION['USER']);
}

/**
 * セッションのユーザー情報を取得
 *
 * @return array | false
 */
function getUserSession()
{
    //セッションを開始していない場合
  if(session_status() === PHP_SESSION_NONE){
    //セッションを開始
    session_start();
  }
  if(!isset($_SESSION['USER'])) {
//セッションにユーザー情報がない
  return false;
}
  $user = $_SESSION['USER'];
//画像のファイル名からファイルのURLを取得
  if(!isset($user['image_name'])){
    $user['image_name'] = null;
}
    $user['image_path'] = buildImagePath($user['image_name'], 'user');
    return $user;
}