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