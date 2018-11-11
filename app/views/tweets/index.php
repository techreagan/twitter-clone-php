<?php require APPROOT . '/views/inc/header.php' ?>
<?php $active='tweets'; $user = $data['user']; $users = $data['users']; $getAllUsers = $data['getAllUsers']; ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main class="section">
  <div class="main-container container">
    <div class="row">
      <div class="col xl3 l4 pl-0 hide-on-med-and-down">
        <div class="card card-profile no-shadow">
          <div class="bg-twitter">
            <div class="img">
              <!-- <img src="<?php echo h($user->profileimg) ?>" alt="<?php echo $user->username . '-avatar' ?>"> -->
              <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-3x white-text"></i></a>
            </div>
          </div>
          <div class="card-content">
            <p><a href="<?php echo url_for('users/profile/') . h($user->username) ?>">
              <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></a>
              <span><?php echo '@' . h($user->username); ?>
            </p>
          </div>
          <div class="card-action pr-0">
            <a href="<?php echo url_for('users/profile/') . $user->username ?>">Tweets<span class="color-twitter center-align"><?php echo h($data['total-tweets']); ?></span></a>
            <a href="<?php echo url_for('users/following/') . $user->username ?>">Following<span class="color-twitter center-align"><?php echo h($data['total-following']); ?></span></a>
            <a href="<?php echo url_for('users/followers/') . $user->username ?>">Followers<span class="color-twitter center-align"><?php echo h($data['total-follower']); ?></span></a>
          </div>
        </div>
      </div>
      <div class="col xl6 l8 m12 s12 pl-0">
        <div class="card card-horizontal tweet no-shadow">
          <form method="post" action="<?php echo url_for('tweets/postTweet') ?>" id="postForm">
            <div class="card-content">
              <div class="input-field">
                <textarea id="tweet-body" class="materialize-textarea" data-length="280" placeholder="What's happening?"></textarea>
              </div>
            </div>
            <div class="card-action right-align">
              <input id="postTweetBtn" type="submit" value="Tweet" class="btn bg-twitter no-shadow">
            </div>
          </form>
        </div>
        <div id="loader" class="hide">
          <p>Sending Tweet</p>
          <div class="progress">
            <div class="indeterminate"></div>
          </div>
        </div>
        <div id="tweets">
        
        </div>
        <div class="col s12 pl-0 hide-on-large-only pr-0">
          <div class="white to-follow">
            <p class="bold">Who to follow . <a href="#viewAll" class="modal-trigger">View all</a></p>
            <ul class="collection">
              <?php if(empty($users)) : ?>
              <p>Non for now.</p>
              <?php else: ?>
              <?php foreach($users as $user): ?>
              <li class="collection-item avatar">
                <a href="<?php echo url_for('users/profile/') . h($user->username) ?>"><i class="fa fa-user fa-4x circle"></i><a>
                <p class="title"><a href="<?php echo url_for('users/profile/') . h($user->username) ?>"><span class="bold"><?php echo ucwords(h($user->firstname)) . ' ' . ucwords(h($user->lastname)); ?></span><span class="color-grey"> @<?php echo h($user->username); ?></span></a> <br>
                <form method="POST" id="followForm">
                  <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
                </form>
                </p>
                <a href="#!" class="secondary-content grey-text"><i class="fa fa-times"></i></a>
              </li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
        
          <div class="card no-shadow footer">
            <div class="card-content">
              <small class="color-grey">&copy; 2018 Twitter</small>
            </div>
            <div class="card-action">
              <a href="#" class="capitalize color-twitter">Advertise with twitter</a>
            </div>
          </div>

        </div>
      </div>
      <div class="col xl3 pl-0 hide-on-med-and-down hide-on-large-only show-on-extra-large pr-0">
        <div class="white to-follow">
          <p class="bold">Who to follow . <a href="#viewAll" class="modal-trigger">View all</a></p>
          <ul class="collection">
            <?php if(empty($users)) : ?>
            <p>Non for now.</p>
            <?php else: ?>
            <?php foreach($users as $user): ?>
            <li class="collection-item avatar">
              <a href="<?php echo url_for('users/profile/') . h($user->username) ?>"><i class="fa fa-user fa-4x circle"></i><a>
              <p class="title"><a href="<?php echo url_for('users/profile/') . h($user->username) ?>"><span class="bold"><?php echo ucwords(h($user->firstname)) . ' ' . ucwords(h($user->lastname)); ?></span><span class="color-grey"> @<?php echo h($user->username); ?></span></a> <br>
              <form method="POST" id="followForm">
                <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
              </form>
              </p>
              <a href="#!" class="secondary-content grey-text"><i class="fa fa-times"></i></a>
            </li>
            <?php endforeach; endif; ?>
          </ul>
        </div>
       
        <div class="card no-shadow footer">
          <div class="card-content">
            <small class="color-grey">&copy; 2018 Twitter</small>
          </div>
          <div class="card-action">
            <a href="#" class="capitalize color-twitter">Advertise with twitter</a>
          </div>
        </div>

      </div>
    <div>
  </div>
  <!-- Modal Structure -->
  <div id="viewAll" class="modal">
    <h5 class="modal-header">Who to follow</h5>
    <div class="modal-content">
      <ul class="collection">
        <?php foreach($getAllUsers as $user): ?>
        <li class="collection-item avatar">
          <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-4x circle"></i><a>
          <p class="title"><a href="<?php echo url_for('users/profile/') . $user->username ?>"><span class="bold"><?php echo ucwords(h($user->firstname)) . ' ' . ucwords(h($user->lastname)); ?></span><span class="color-grey"> @<?php echo h($user->username); ?></span></a> <br>
          <form method="POST" id="followForm">
            <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
          </form>
          </p>
          <a href="#!" class="secondary-content grey-text"><i class="fa fa-times"></i></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
});
</script>
<script src="<?php echo url_for('js/index.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>