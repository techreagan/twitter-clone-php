<?php require APPROOT . '/views/inc/header.php' ?>
<?php $user = $data['user']; $searchResults = $data['searchResults']; ?>
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
            <p><a href="<?php echo url_for('users/profile/') . $user->username ?>">
              <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></a>
              <span><?php echo '@' . h($user->username); ?>
            </p>
          </div>
          <div class="card-action pr-0">
            <a href="<?php echo url_for('users/profile/') . $user->username ?>">Tweets<span class="color-twitter center-align"><?php echo $data['total-tweets']; ?></span></a>
            <a href="<?php echo url_for('users/following/') . $user->username ?>">Following<span class="color-twitter center-align"><?php echo $data['total-following']; ?></span></a>
            <a href="<?php echo url_for('users/followers/') . $user->username ?>">Followers<span class="color-twitter center-align"><?php echo $data['total-follower']; ?></span></a>
          </div>
        </div>
      </div>
      <div class="col xl6 l8 m12 s12 pl-0">
      <form action="<?php echo url_for('users/search/') ?>" method="get" class="hide-on-large-only">
        <div class="input-field">
          <input id="search" name="user" type="text" placeholder="Search Twitter">
        </div>
        <button type="submit" class="btn no-shadow bg-twitter" id="searchBtn"><i class="fa fa-search"></i></button>
      </form>
      <?php if($searchResults === ''): ?>
      <h4 class="center-align">Search for people on twitter.</h4>
      <?php elseif (!$searchResults): ?>
      <h4 class="center-align">User not found.</h4>
      <?php else: ?>
      <ul class="collection">
        <?php foreach($searchResults as $user): ?>
        <li class="collection-item avatar">
          <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-4x circle"></i><a>
          <p class="title"><a href="<?php echo url_for('users/profile/') . $user->username ?>"><span class="bold"><?php echo ucwords(h($user->firstname)) . ' ' . ucwords(h($user->lastname)); ?></span><br><span class="color-grey"> @<?php echo h($user->username); ?></span></a> <br>
          <?php if($user->id !== $_SESSION['user_id']): ?>
          <form method="POST" id="followForm">
            <button type="submit" class="btn white color-twitter no-shadow follow-btn <?php echo $data['follow']->isFollow($_SESSION['user_id'], $user->id); ?>" data-follower-id="<?php echo $_SESSION['user_id'] ?>" data-following-id="<?php echo $user->id ?>" id="followBtn">Follow</button>
          </form>
          <?php endif;?>
          </p>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
      </div>
      
    <div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script src="<?php echo url_for('js/search.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>