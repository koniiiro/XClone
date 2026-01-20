<?php
/////////////////////////
//ユーザーデータを処理
///////////////////////////

/**
 * ユーザーを作成
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
 * ユーザー情報を更新
 * 
 * @param array $data
 * @return bool
 */
function updateUser(array $data)
{
     //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

     //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    //更新日時を保存データに追加
    $data['updated_at'] =date('Y-m-d H:i:s');

    //パスワードがある場合→ハッシュ値に変換
    if(isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    // SQLクエリ作成準備

    // （UPDATE table_name
    // SET column1 = "value1", column2 = "value2",...
    // WHERE condition;）

    // ユーザーIDをエスケープ
    $user_id = $mysqli->real_escape_string($data['id']);
    // SET句のカラムを準備
    $set_columns = [];
    foreach(['name', 'nickname', 'email', 'password', 'image_name', 'updated_at'] as $column) {
        //入力があれば、更新の対象にする
        if(isset($data[$column]) && $data[$column] !== '') {
            $value = $mysqli->real_escape_string($data[$column]);
            $set_columns[] = $column . ' = "' . $value . '"';
        }
    }

    // SQLクエリ作成
    $query = 'UPDATE users ';
    $query .= ' SET ' . join(',', $set_columns);
    $query .= ' WHERE id = ' . $user_id;

    // SQLクエリを実行
    $response = $mysqli->query($query);

    // SQLエラーの場合
    if($response === false) {
        echo 'エラーメッセージ：' . $mysqli->error . "\n";

    // DB接続を開放
    $mysqli->close();

    return $response;
    }
 }

//メールアドレスからユーザーを取得
/**
 * @param string $email
 *  @param string $password
 * @return array|false
 */
function findUserAndCheckPassword(string $email, string $password)
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
//メールアドレスからユーザーを取得して、パスワードを確認
/**
 * @param string $email
 * @return array|false
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

/**
 * @param integer $user_id
 * @param integer|null $login_user_id
 * @return array|false
 */
function findUser(int $user_id, int $login_user_id = null )
{ 
    
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }

    // エスケープ
    $user_id = $mysqli->real_escape_string($user_id);
    $login_user_id = $mysqli->real_escape_string($login_user_id);

    //検索のSQLを作成
    $query = <<<SQL
    SELECT
        U.id,
        U.nickname,
        U.name,
        U.email,
        U.image_name,
        -- フォロー中の数
        (SELECT COUNT(1) FROM follows WHERE status = 'active' AND follow_user_id = U.id) AS follow_user_count,
        -- フォワー中の数
        (SELECT COUNT(1) FROM follows WHERE status = 'active' AND followed_user_id = U.id) AS followed_user_count,
       -- ログインユーザーがフォローしている場合、follow ID が入る
       F.id AS follow_id
    FROM users AS U 
        -- ログインしているユーザーがフォローしているかを確認
        LEFT JOIN follows AS F
            ON F.status = 'active' AND F.followed_user_id = '$user_id' AND F.follow_user_id = '$login_user_id'
    WHERE U.status = 'active' AND U.id = '$user_id'
    SQL;

    //SQLを実行
    if($result = $mysqli->query($query)){
        //データを配列で返却
        $response = $result->fetch_array(MYSQLI_ASSOC);
    }else{   
        //失敗
        $response = false;
        echo 'エラーメッセージ:' . $mysqli->error . "\n";
    }
    // DB接続を開放
$mysqli->close();

    // 結果を返却
    return $response;
}