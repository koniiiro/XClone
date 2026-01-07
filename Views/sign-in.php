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
<link rel="stylesheet" href="<?php echo HOME_URL ?>Views/css/style.css">

<title>ログイン画面/Xクローン</title>
<meta name="description" content="ログイン画面です">
</head>
<body class="signup text-center">
    <main class="form-signup">
        <form action="sign-in.php" method="post">
            <img src="<?php echo HOME_URL ?>Views/img/logo-white.svg" alt="" class="logo-white">
            <h1>Xクローンにログイン</h1>
            <input type="email" class="form-control" name="email" placeholder="メールアドレス" maxlength="254" required autofocus>
            <input type="password" class="form-control" name="password" placeholder="パスワード" minlength="4" maxlength="128" required>
            <button class="w-100 btn btn-lg mt-3 mb-2" type="submit">ログイン</button>
            <p class="mt-3 mb-2"><a href="sign-up.php">会員登録する</a></p>
        </form>
    </main>
</body>
</html>