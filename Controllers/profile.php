
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

/////////////////////////
//プロフィールコントローラー
///////////////////////////

//設定を読み込み
include_once'../config.php';
// 便利な関数を読み込む
include_once '../util.php';

//ユーザーデータ操作モデルを読み込む
include_once '../Models/users.php';
//ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

//ログインチェック
$user = getUserSession();
if(!$user){
    //ログインしていない
    header('Location:' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}

//ユーザー情報変更
//ニックネーム・ユーザー名・メールアドレスが入力されている場合
if(true){
    //TODO: ユーザー情報変更する処理
}
//-------------------------------------------------
//表示するユーザーIDを取得(デフォルトはログインユーザー)
//-------------------------------------------------
//URLにuser_idがある場合は、それを表示するユーザーとする
$requested_user_id = $user['id'];
if(isset($_GET['user_id'])) {
    $requested_user_id = $_GET['user_id'];
}

// 画面表示データ
//ユーザー情報
$view_user = $user;
//プロフィール詳細を取得
$view_requested_user = findUser($requested_user_id, $user['id']);
// ツイート一覧を取得
$view_tweets = findTweets($user, null, [$requested_user_id]);

// // //DEBUG
// echo '==view_requested_user==';
// var_dump($view_requested_user);
// echo '==view_tweets==';
// var_dump($view_tweets);


include_once '../Views/profile.php';
