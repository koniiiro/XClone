<?php

/////////////////////////
//フォローコントローラー
///////////////////////////

//設定を読み込み
include_once'../config.php';
// 便利な関数を読み込む
include_once '../util.php';

//フォローデータ操作モデルを読み込み
include_once '../Models/follows.php';

//ログインチェック
$user = getUserSession();
if(!$user){
    //404エラー
    header('HTTP/1.0 404 Not Found');
    exit;
}

//フォローする
$follow_id = null;
// フォローしたい相手のユーザーIDがセットされているか確認
if(isset($_POST['followed_user_id'])){
    $data = [
        'followed_user_'=> $_POST['followed_user_'],
        'follow_user_id'=> $user['id'],
    ];
    //フォロー登録
    $follow_id = createFollow($data);
}

//フォロー削除する
if(isset($_POST['follow_id'])){
    $data=[
    'follow_id'=> $_POST['follow_id'],
    'user_id'=> $user['id'],
    ];

    //フォローを削除
    deleteFollow($data);
}

//JSON形式で結果を返却
$response = [
    'message'=>'successful',
    //フォローしたときには値が入ります
    'follow_id'=>$follow_id,
];
header('Content-Type: application/json; charset=uft-8');
echo json_encode($response);
