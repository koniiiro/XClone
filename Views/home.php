<?php
//  エラー表示あり 
ini_set('display__errors',1);
// 日本時間に設定する
date_default_timezone_set('Asia/Tokyo');
//URLディレクトリ設定
define('HOME_URL','/XClone/');

//////////////////////////
//ツイート一覧
$view_tweets = [
  [
    'user_id' => 1,
    'user_name' => 'taro',
    'user_nickname' => '太郎',
    'user_image_name' => 'sample-person.jpg',
    'tweet_body' =>'今プログラミングをしています。',
    'tweet_image_name' => null,
    'tweet_created_at' =>'2024-04-28 12:00:00',
    'like_id' => null,
    'like_count' => 0,
  ],
    [
    'user_id' => 2,
    'user_name' => 'jiro',
    'user_nickname' => '次郎',
    'user_image_name' => null,
    'tweet_body' =>'コワーキングスペースをオープンしました！',
    'tweet_image_name' => 'sample-post.jpg',
    'tweet_created_at' =>'2024-04-30 12:00:00',
    'like_id' => 1,
    'like_count' => 1,
    ],
  ];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?PHP echo HOME_URL; ?>Views/img/logo-twitterblue.svg" type="image/x-icon">
      <!-- // httpローカルホストから記載する、フルパス記載の方法→　href="http://localhost/XClone/Views/img/logo-twitterblue.svg" -->
      <!-- //ドメイン配下から記載する、絶対パス記載の方法→　href="/XClone/Views/img/logo-twitterblue.svg" -->
    
      <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?PHP echo HOME_URL; ?>/Views/css/style.css">
  
    <title>ホーム画面 / Xクローン</title>
    <meta name="description" content="ホーム画面です" >
</head>
<body class="home">
    <div class="container">
      <div class="side">
       <div class="side-inner">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-home.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-search.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-notification.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-profile.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
          <li class="nav-item my-icon"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt=""></a></li>
        </ul>

       </div> 
      </div>
      <div class="main">
        <div class="main-header">
          <h1>ホーム</h1>
        </div>
        <!-- つぶやき投稿エリア -->
         <div class="tweet-post">
          <div class="my-icon">
  <img src="<?PHP echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
        </div>
  <div class="input-area">
  
          <form action="post.php" method="post" enctype="multipart/form-data">
            <textarea name="body" placeholder="いまどうしている？" maxlength="140"></textarea>
          <div class="bottom-area">
            <div class="mb-0">
            <input type="file" name="img" class="form-control form-control-sm" >
          </div>
          <button class="btn" type="submit">つぶやく</button>
          </div>
          </form>
          </div>
         </div>
         <!-- つぶやき仕切りエリア -->
          <div class="ditch"></div>

          <!-- つぶやき一覧エリア -->
            <div class="tweet-list">
            <div class="tweet">
               <div class="user">
                 <a href="profile.php?user_id=1">
                  <img src="<?PHP echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="">
                 </a>
               </div>
                <div class="content">
                  <div class="name">
                    <a href="profile.php?user_id=1">
                      <span class="nickname">太郎</span>
                      <span class="user-name">＠taro・2日前</span>
                      </a>
                  </div>
                  <p>今プログラミングをしています。</p>
                  <div class="icon-list">
                    <div class="like">
                      <img src="<?PHP echo HOME_URL; ?>Views/img/icon-heart.svg" alt="">
                    </div>
                    <div class="like-count">0</div>
                  </div>
                </div>
            </div>
            <div class="tweet">
              <div class="user">
                <a href="profile.php?user_id=1">
                  <img src="<?PHP echo HOME_URL; ?>Views/img/icon-default-user.svg" alt="">
                </a>
              </div>
              <div class="content">
                <div class="name">
                  <a href="profile.php?user_id=1">
                    <span class="nickname">次郎</span>
                    <span class="user-name">@jiro・3日前</span>
                    </a>
                </div>
                <p>コワーキングスペースをオープンしました！</p>
                <img src="<?PHP echo HOME_URL; ?>Views/img_uploaded/tweet/sample-post.jpg" alt="" class="post-image">
                <div class="icon-list">
                  <div class="like">
                    <img src="<?PHP echo HOME_URL; ?>Views/img/icon-heart-twitterblue.svg" alt="">
                  </div>
                  <div class="like-count">1</div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</body>
</html>