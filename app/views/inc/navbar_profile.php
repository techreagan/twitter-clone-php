<nav id="navbar" class="white navbar navbar-fixed hide-on-med-and-down">
  <div class="container main-container">
    <div class="row">
      <div class="col xl9 l8 offset-xl3 offset-l4 pl-0">
        <div class="nav-wrapper">
          <?php if($user->id == $_SESSION['user_id']): ?>
          <a href="<?php echo url_for('users/editprofile/') . $data['username'] ?>" class="color-twitter right">Edit Profile</a>
          <?php endif; ?>
          <ul id="profileNav" class="left hide-on-med-and-down">
            <li><a href="<?php echo url_for('users/profile/') . h($data['username']) ?>" class="color-black<?php echo $active === 'user_tweets' ? ' active': ''; ?>">Tweets<span><?php echo $data['total-tweets']; ?></span></a></li>
            <li><a href="<?php echo url_for('users/following/') . h($data['username']) ?>" class="color-black<?php echo $active === 'following' ? ' active': ''; ?>">Following<span><?php echo $data['total-following']; ?></span></a></li>
            <li><a href="<?php echo url_for('users/followers/') . h($data['username']) ?>" class="color-black<?php echo $active === 'followers' ? ' active': ''; ?>">Followers<span><?php echo $data['total-follower']; ?></span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>