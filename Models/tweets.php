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


/**
 * ツイート一覧を取得
 * 
 * @param array $user
 * @return array|false
 */

function findTweets(array $user)
    {
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }

    //ログインユーザーIDをエスケープ
$login_user_id = $mysqli->real_escape_string($user['id']);

//検索のSQLを作成
$query = <<<SQL
    SELECT
        T.id AS tweet_id,
        T.status AS tweet_status,
        T.body AS tweet_body,
        T.image_name AS tweet_image_name,
        T.created_at AS tweet_created_at,
        U.id AS user_id,
        U.name AS user_name,
        U.nickname AS user_nickname,
        U.image_name AS user_image_name,
    -- ログインユーザーがいいね！したか（している場合、値が入ります）
    L.id AS like_id,
    -- いいね！数
    (SELECT COUNT(*) FROM likes WHERE status ='active' AND tweet_id = T.id) AS like_count
    FROM tweets AS T
    -- ユーザーテーブルを紐づける
    JOIN users AS U
         ON U.id = T.user_id AND U.status ='active'
    -- いいね！テーブルを紐づける
    LEFT JOIN likes AS L
        ON L.tweet_id = T.id AND L.status = 'active' AND L.user_id = '$login_user_id'    
    where T.status = 'active'
SQL;

//SQL実行
  if($result = $mysqli->query($query)) {
    //データを配列で受け取る
    $response = $result->fetch_all(MYSQLI_ASSOC);
  }else{
    $response = false;
    echo 'エラーメッセージ: ' . $mysqli->error . "\n";
  }

  $mysqli->close();
  return $response;
    }

 