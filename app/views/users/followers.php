<?php require APPROOT . '/views/inc/header.php' ?>
<?php $active = 'followers'; $user = $data['user']; require APPROOT . '/views/inc/navbar.php' ?>
<?php $users = $data['users']; $tweets = $data['tweets']; ?>
<div class="banner">
  <div id="bigProfileImage">
    <a href="#"><i class="fa fa-user fa-3x white-text"></i></a>
</div>
</div>
<?php require APPROOT . '/views/inc/navbar_profile.php' ?>
<main class="section">
  <div class="main-container container">
    <div class="row">
      <div class="col xl3 l4 pl-0" id="user-profile">
        <div class="card no-shadow">
          <div class="card-content pl-0 pr-0">
            <h1><a href="<?php echo url_for('users/profile/') . $data['username']; ?>">
              <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></a>
            </h1>
            <p class="handle">@<a href="#"><?php echo h($user->username); ?></a></p>
            <p class="bio"><?php echo !(empty($user->bio)) ? $user->bio : "Edit your profile to add your bio"; ?></p>
          </div>
          <div class="card-action pr-0 hide-on-large-only">
            <a href="<?php echo url_for('users/profile/') . $user->username ?>">Tweets<span class="color-twitter center-align"><?php echo $data['total-tweets']; ?></span></a>
            <a href="<?php echo url_for('users/following/') . $user->username ?>">Following<span class="color-twitter center-align"><?php echo $data['total-following']; ?></span></a>
            <a href="<?php echo url_for('users/followers/') . $user->username ?>">Followers<span class="color-twitter center-align"><?php echo $data['total-follower']; ?></span></a>
          </div>
          
        </div>
      </div>
      
      <div class="col xl6 l8 m12 s12 pl-0">
  
        <div id="following">
          <?php if(!$data['followers']): ?>
          <p class="center-align">No followers yet.</p>
          <?php else: ?>
          <?php foreach($data['followers'] as $follower_users): ?>
          <?php foreach($data['follow']->getFollow($follower_users->follower_id) as $user): ?>
          <div class="col m6 s12 pl-0">
            <div class="card card-profile no-shadow">
              <div class="bg-twitter">
                <div class="img">
                  <!-- <img src="<?php echo h($user->profileimg) ?>" alt="<?php echo $user->username . '-avatar' ?>"> -->
                  <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-3x white-text"></i></a>
                </div>
              </div>
              <div class="card-content">
                <p><a href="<?php echo url_for('users/profile/') . $user->username ?>">
                  <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></a>
                  <span><?php echo '@' . h($user->username); ?><?php echo $data['follow']->findFollow($user->id, $_SESSION['user_id']) && $_SESSION['user_id'] != $user->id ? '<i class="isFollow">Follows you</i>' : '' ?></span>
                </p>
          
                <div class="followForm section">
                  <?php if($_SESSION['user_id'] != $user->id): ?>
                  <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
                  <?php endif; ?>
                </div>
                
              </div>
            </div>
          </div>
          <?php endforeach; endforeach; endif; ?>
        </div>

      </div>
      <div class="col xl3 pl-0 hide-on-med-and-down hide-on-large-only show-on-extra-large">
        <div class="white to-follow">
          <p class="bold">Who to follow . <a href="#">View all</a></p>

          <ul class="collection">
            <?php foreach($users as $user): ?>
            
            <li class="collection-item avatar">
              <a href="<?php echo url_for('users/profile/') . $user->username; ?>"><i class="fa fa-user fa-4x circle"></i><a>
              <p class="title truncate"><a href="<?php echo url_for('users/profile/') . $user->username; ?>"><span class="bold"><?php echo ucwords(h($user->firstname)) . ' ' . ucwords(h($user->lastname)); ?></span><span class="color-grey"> @<?php echo h($user->username); ?></span></a> <br>
        
              <div class="followForm">
                <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
              </div>
              </p>
              <a href="#!" class="secondary-content grey-text"><i class="fa fa-times"></i></a>
            </li>
      
            <?php endforeach; ?>
            
          </ul>
        </div>
      
        <div class="card no-shadow footer">
          <div class="card-content">
            <small class="color-grey">&copy; 2018 Twitter</small>
          </div>
          <div class="card-action">
            <a href="">Advertise with twitter</a>
          </div>
        </div>

      </div>
    <div>
  </div>
</main>
<input type="hidden" id="username" name="username" value="<?php echo $data['username']; ?>">
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script src="<?php echo url_for('js/follow.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>