<?php
/////////////////////////
//フォローデータを処理
///////////////////////////


/**
 * フォローを作成
 * @param  array 
 * @param  int|false
 *  
 */
function createFollow(array $data)
{
    //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    //----------------------------
    //SQLクエリを作成（新規登録）
    //----------------------------
    $query = 'INSERT INTO Follows (follow_user_id, followed_user_id) VALUES(?, ?)';
    $statement = $mysqli->prepare($query);

    //プレースホルダ―に値をセット
    $statement->bind_param('ii', $data['follow_user_id'], $data['followed_user_id']);

    //----------------------------
    //戻り値を作成
    //----------------------------
    //クエリを実行し、SQＬエラーでない場合
    if($statement->execute()){
    //戻り値用の変数にセット：インサートＩＤ(likes.id)
    $response = $mysqli->insert_id;
    }else{
    //結果を失敗で返却
    $response = false;
    echo 'エラーメッセージ：' . $mysqli->error . "\n";

    }
    //----------------------------
    //後処理
    //----------------------------
    //ＤＢ接続を開放
    $statement->close();
    $mysqli->close();
    return $response;
    }

/**
 * フォローを削除
 * @param  array $data
 * @param  bool
 */
function deleteFollow(array $data){

     //DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //接続エラーの場合    
    if($mysqli->connect_errno){
        echo 'MYSQLの接続に失敗しました。: ' . $mysqli->connect_error . "\n";
        exit;
    }
    //----------------------------
    //SQLクエリを作成
    //----------------------------
    //理論削除のクエリを作成
    $query = 'UPDATE Follows SET status = "deleted" WHERE id = ? AND follow_user_id = ?';
    $statement = $mysqli->prepare($query);

    //プレースホルダ―にセット
    $statement->bind_param('ii', $data['follow_id'], $data['follow_user_id']);

    //----------------------------
    //戻り値を作成
    //----------------------------
    $response = $statement->execute();

    //SQＬエラーの場合 -> エラー表示
    if($response === false){
    echo 'エラーメッセージ：' . $mysqli->error_clear_last . "\n";
    }

    //----------------------------
    //後処理
    //----------------------------
    //ＤＢ接続を開放
    $statement->close();
    $mysqli->close();
    return $response;
}
