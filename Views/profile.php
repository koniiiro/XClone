<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Views/img/logo-twitterblue.svg" type="image/x-icon">
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
<script src="../Views/js/like.js" defer></script>

<title>プロフィール画面 / Xクローン</title>
    <meta name="description" content="プロフィール画面です" >
</head>
<body class="home profile text-center">
    <div class="container">
      <div class="side">
       <div class="side-inner">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-home.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-search.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-notification.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-profile.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="../Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
          
          <li class="nav-item my-icon"><img src="../Views/img_uploaded/user/sample-person.jpg" alt="" class="js-popover" 
            data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" 
            data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
          <a href="home.php" class="nav-link">
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
        <div class="user"><img src="../Views/img_uploaded/user/sample-person.jpg" alt=""></div>
        <button class="btn btn-reverse btn-sm">プロフィール編集</button>
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