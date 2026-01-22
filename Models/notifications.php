<?php
/////////////////////////
//通知データを処理
///////////////////////////

/**
 * 通知を作成
 *
 * @param array array{received_user_id:int,sent_user_id:int,message:string} $data
 * @return int|false
 */
function createNotification(array $data)
{
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    // SQLクエリを作成(通知新規登録)
    $query = 'INSERT INTO notifications(received_user_id, sent_user_id, message) VALUES(?, ?, ?)';

    //プリペアドステートメントに、作成したクエリを登録
    $statement = $mysqli->prepare($query);

    //クエリをプレースホルダ(？)にカラムの値を紐づけ
    $statement->bind_param('iis', $data['received_user_id'], $data['sent_user_id'], $data['message']);
    
    // クエリを実行
    $response = $statement->execute();

    //エラーの場合は、エラー表示
    if($response === false){
        echo 'エラーメッセージ :' . $mysqli->error . "\n";
    }

    //DB接続を開放
    $statement->close();
    $mysqli->close();

    //結果を返却
    return $response;
}

