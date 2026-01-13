<?php
/////////////////////////
//ツイートデータを処理
///////////////////////////

/**
 * ツイートを作成
 *
 * @param array $data
 * @return bool
 */
function createTweet(array $data)
{
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    // SQLクエリを作成(ツイート新規登録)
    $query = 'INSERT INTO tweets(user_id, body, image_name) VALUES(?, ?, ?)';

    //プリペアドステートメントに、作成したクエリを登録
    $statement = $mysqli ->prepare($query);

    //クエリをプレースホルダ(？)にカラムの値を紐づけ
    $statement->bind_param('iss', $data['user_id'], $data['body'],$data['image_name']);
    
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
