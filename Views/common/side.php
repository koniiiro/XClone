      <div class="side">
       <div class="side-inner">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/logo-twitterblue.svg" alt="" class="icon"></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-home.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-search.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-notification.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-profile.svg" alt=""></a></li>
          <li class="nav-item"><a href="home.php" class="nav-link"><img src="<?PHP echo HOME_URL; ?>Views/img/icon-post-tweet-twitterblue.svg" alt="" class="post-tweet"></a></li>
          <li class="nav-item my-icon"><img src="<?php echo html_escapse($user['image_path']); ?>" class="js-popover" alt="" data-bs-container="body" 
          data-bs-toggle="popover" data-bs-placement="right" data-bs-html="true" data-bs-content="<a href='profile.php'>プロフィール</a><br><a href='sign-out.php'>ログアウト</a>"></li>
          <!-- <a href="home.php" class="nav-link"> -->
        </ul>
       </div> 
     </div>