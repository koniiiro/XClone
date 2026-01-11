<?php
/////////////////////////
//ユーザーデータを処理
///////////////////////////

/**
 * ユーザーを作成
 *
 * @param array $data
 * @return bool
 */
function createUser(array $data){
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    // SQLクエリを作成(ユーザー新規登録)
    $query = 'INSERT INTO users(email, name, nickname, password) VALUES(?, ?, ?, ?)';

    //パスワードをハッシュ値に変換
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //プリペアドステートメントに、作成したクエリを登録
    $statement = $mysqli ->prepare($query);

    //クエリをプレースホルダ(？)にカラムの値を紐づけ
    $statement->bind_param('ssss', $data['email'], $data['name'],$data['nickname'],$data['password']);
    
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
 * @param string $email
 * @return array | false
 */
function findUserByEmail(string $email)
{
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }

    // クエリ作成
    // 入力値をエスケープ
    $email = $mysqli->real_escape_string($email);
    $query = 'SELECT * FROM users WHERE email = "' . $email . '"';

    // SQL実行
$result = $mysqli->query($query);
if(!$result){

    //MYSQL処理中にエラー発生
    echo 'エラーメッセージ: ' . $mysqli->error ."\n";
    $mysqli->close();
    return false; 
}

//ユーザー情報を取得
$user = $result->fetch_array(MYSQLI_ASSOC);
if(!$user){
    //ユーザーが存在しない
    $mysqli->close();
    return false;
}

    // DB開放
$mysqli->close();

    // 結果を返却
    return $user;
}