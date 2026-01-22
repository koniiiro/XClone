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

/**
 * 通知の一覧を取得
 *@param int $user_id
 * @return array|false
 */
function findNotifications(int $user_id){

    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }

    //エスケープ
    $user_id = $mysqli->real_escape_string($user_id);

    //SQLクエリを作成
    $query = <<<SQL
        SELECT
            
            N.id AS notification_id,
            N.message as notification_message,

            U.name AS user_name,
            U.nickname AS user_nickname,
            U.image_name AS user_image_name 
        FROM notifications AS N 
            JOIN users AS U
                ON U.id = N.sent_user_id AND U.status = 'active'
        WHERE N.status = 'active' AND N.received_user_id ='$user_id'

        ORDER BY N.created_at DESC
        LIMIT 50
    SQL;

    // var_dump($query);
    // exit;

    //クエリを実行
    if($result = $mysqli->query($query)) {
        //全件取得
        $notifications = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $notifications = false;
        echo 'エラーメッセージ: ' . $mysqli->error . "\n";
    }
    $mysqli->close();
    return $notifications;
}