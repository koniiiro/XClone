<?php
// 設定関連を読み込む
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include_once('../Views/common/head.php'); ?>
  
<title>つぶやく画面 / Xクローン</title>
    <meta name="description" content="つぶやく画面です" >
</head>
<body class="home">
    <div class="container">
  <?php include_once('../Views/common/side.php'); ?> 
         <div class="main">
         <div class="main-header">
           <h1>つぶやく</h1>
         </div>

        <!-- つぶやき投稿エリア -->
        <?php include_once('../Views/common/tweet-post.php'); ?> 

         <!-- つぶやき仕切りエリア -->
        <div class="ditch"></div>
      </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
</body>
</html>