<?php
/////////////////////////
//サインインコントローラー
///////////////////////////



//設定を読み込み
include_once'../config.php';
// 便利な関数を読み込む
include_once('../util.php');
//ユーザーデータ操作モデルを読み込み
include_once '../Models/users.php';

//ログイン結果
$try_login_result = null;

//メールアドレスとパスワードが入力されている場合
if(isset($_POST['email']) && isset($_POST['password'])) {
    // ログインチェックを実行
    $user = [];

    // ログインに成功した場合
    if($user){
        // ユーザー情報をセッションに保存

        // ホーム画面への遷移
        header('Location:' .HOME_URL . 'Controllers/home.php');
        exit;
    }else{
        //ログイン結果を失敗にする
        $try_login_result = false;
    }
}
//画面表示
$view_try_login_result = $try_login_result;
include_once '../Views/sign-in.php';

