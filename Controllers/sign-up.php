<?php
/////////////////////////
//サインアップコントローラー
///////////////////////////

//設定を読み込み
include_once'../config.php';
// 便利な関数を読み込む
include_once('../util.php');
//ユーザーデータ操作モデルを読み込み
include_once '../Models/users.php';

//エラーメッセージ格納用
$error_messages = [];

//登録項目がすでに入力されているか確認
if(isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ) {
    $data = [
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];


    //バリデーション
    //重複メールアドレスの確認
    if(findUserByEmail($data['email'])){
        $error_messages[]='メールアドレスは使用されています。';
    }
    //その他の実装すべきバリデーション(今回は実装しない)
    // －文字制限
    // －メールアドレスの形式かどうかを確認
    // －重複ユーザー名の確認
    //エラーが無ければ登録する

    if(!$error_messages){

    //ユーザーを作成して、成功すれば
    if(createUser($data)){
        //ログイン画面に遷移
        header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
        exit;
        }
    }
}

//画面表示
$view_error_messages = $error_messages;
include_once '../Views/sign-up.php';

