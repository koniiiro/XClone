<?php
// 設定関連を読み込む
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');


////////////////////////////
//ツイート一覧
///////////////////////////
$view_tweets = [
  [
    'user_id' => 1,
    'user_name' => 'taro',
    'user_nickname' => '太郎',
    'user_image_name' => 'sample-person.jpg',
    'tweet_body' =>'今プログラミングをしています。',
    'tweet_image_name' => null,
    'tweet_created_at' =>'2025-12-15 10:49:00',
    'like_id' => '',
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- Bootstrap js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!-- いいね！JS -->
<script src="<?php echo HOME_URL ?>Views/js/like.js" defer></script>

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
          
          <li class="nav-item my-icon"><img src="<?PHP echo HOME_URL; ?>Views/img_uploaded/user/sample-person.jpg" alt="" class="js-popover" 
            data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" 
            data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
          <a href="home.php" class="nav-link">
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
                  <input type="file" name="image" class="form-control form-control-sm">
                </div>
                <button class="btn" type="submit">つぶやく</button>
         </div>
              </form>
      </div>
  </div>

         <!-- つぶやき仕切りエリア -->
          <div class="ditch"></div>

          <!-- つぶやき一覧エリア -->
           <?php if (empty($view_tweets)) : ?>
             <p class="p-3">ツイートがありません。</p>
             <?php else: ?>
              <div class="tweet-list">
               <?php foreach ($view_tweets as $view_tweet) : ?>
                  <div class="tweet">
                    <div class="user">
                      <a href="profile.php?user_id=<?php echo html_escapse($view_tweet['user_id']); ?>">
                        <img src="<?php echo buildImagePath($view_tweet['user_image_name'], 'user'); ?>" alt=""> 
                     </a>
                  </div>
                <div class="content">
                  <div class="name">
                    <a href="profile.php?user_id=<?php echo html_escapse($view_tweet['user_id']); ?>">
                      <span class="nickname"><?php echo html_escapse($view_tweet['user_nickname']); ?></span>
                      <span class="user-name">@<?php echo html_escapse($view_tweet['user_name']); ?>・<?php  echo convertToDayTimeAgo($view_tweet['tweet_created_at']); ?></span>
                    </a>
                  </div>
                  <p><?php echo html_escapse($view_tweet['tweet_body']); ?></p>
                  <?php if (isset ($view_tweet['tweet_image_name'])) : ?>
                    <img src="<?php echo buildImagePath($view_tweet['tweet_image_name'], 'tweet'); ?>" alt="" class="post-image">
                  <?php endif; ?>

                    <div class="icon-list">
                    <div class="like js-like" data-like-id="<?php echo html_escapse($view_tweet['like_id']); ?>">
                      <?php if (isset($view_tweet['like_id'])){
                        // /いいね！している場合、青のハートアイコンを表示
                        echo '<img src="'.HOME_URL . 'Views/img/icon-heart-twitterblue.svg" alt="">';
                      } else {
                        ///いいね！していない場合、グレーのハートアイコンを表示
                        echo '<img src="' . HOME_URL . 'Views/img/icon-heart.svg" alt="">';
                      }
                      ?>
                    </div>
                    <div class="like-count js-like-count"><?php echo html_escapse($view_tweet['like_count']); ?></div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('.js-popover').popover();
      })
    </script>
</body>
</html>