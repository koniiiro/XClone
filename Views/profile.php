<?php
// 設定関連を読み込む
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo HOME_URL ?>Views/img/logo-twitterblue.svg" type="image/x-icon">
      <!-- // httpローカルホストから記載する、フルパス記載の方法→　href="http://localhost/XClone/Views/img/logo-twitterblue.svg" -->
      <!-- //ドメイン配下から記載する、絶対パス記載の方法→　href="/XClone/Views/img/logo-twitterblue.svg" -->
    
<!-- Bootstrap css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="..//Views/css/style.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- Bootstrap js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!-- いいね！JS -->
<script src="<?php echo HOME_URL ?>Views/js/like.js" defer></script>

<title>プロフィール画面 / Xクローン</title>
    <meta name="description" content="プロフィール画面です" >
</head>
<body class="home profile text-center">
    <div class="container">
      <div class="side">
       <div class="side-inner">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/icon-home.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/icon-search.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/icon-notification.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/icon-profile.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?php echo HOME_URL ?>Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
          
          <li class="nav-item my-icon"><img src="<?php echo HOME_URL ?>Views/img_uploaded/user/sample-person.jpg" alt="" class="js-popover" 
            data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" 
            data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
          <!-- <a href="home.php" class="nav-link"> -->
        </ul>
    </div> 
      </div>
        <div class="main">
          <div class="main-header">
          <h1>太郎</h1>
        </div>

        <!-- プロフィールエリア -->
 <div class="profile-area">
    <div class="top">
        <div class="user"><img src="<?php echo HOME_URL ?>Views/img_uploaded/user/sample-person.jpg" alt=""></div>
        
        <?php if(isset($_GET['user_id'])): ?>
          <!-- 相手のページ：フォローボタン -->
           <?php if(isset($_GET['case'])): ?>
             <button class="btn btn-sm">フォローを外す</button>
           <?php else: ?>
             <button class="btn btn-sm btn-reverse">フォローする</button>
        <?php endif; ?>
        <?php else: ?>
         <!-- プロフィール：プロフィール編集ボタン -->
        <button class="btn btn-reverse btn-sm" data-bs-toggle="modal" data-bs-target="#js-modal">プロフィール編集</button>
        <?php endif; ?>

    <div class="modal fade" id="js-modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">プロフィール編集</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="user">
                <img src="<?php echo HOME_URL ?>Views/img_uploaded/user/sample-person.jpg" alt="">
              </div>
              <input type="text" class="form-control mb-4" name="nickname" value="太郎" placeholder="ニックネーム" maxlength="50" required autofocus>
              <input type="text" class="form-control mb-4" name="name" value="taro" placeholder="ユーザー名、例）techis123" maxlength="50" required>
              <input type="email" class="form-control mb-4" name="email" value="taro@techis.jp" placeholder="メールアドレス" maxlength="254" required>
              <input type="password" class="form-control mb-4" name="password" value="" placeholder="パスワードを変更する場合は入力" minlength="4" maxlength="128" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
              <button type="button" class="btn" type="submit">保存する</button>
            </div>
          </form>

        </div>
      </div>
    </div>
      </div>
        <div class="name">太郎</div>
        <div class="text-muted">@taro</div>
        <div class="follow-follower">
          <div class="follow-count">1</div>
          <div class="follow-text">フォロー中</div>
          <div class="follow-count">1</div>
          <div class="follow-text">フォロワー</div>
       </div>
      </div>
         <!-- 仕切りエリア -->
          <div class="ditch"></div>

          <!-- TODO:つぶやき一覧エリア -->
        </div>
    </div>
    <script>
      $(document).ready(function(){
        $('.js-popover').popover();
      })
    </script>
</body>
</html>