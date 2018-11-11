<nav id="navbar" class="white navbar navbar-fixed">
  <div class="container<?php echo Auth::isLoggedIn() ? " main-container" : '' ?>">
    <div class="nav-wrapper">
      <a href="<?php echo url_for('tweets') ?>" class="brand-logo color-black center"><i class="fab fa-twitter color-twitter icon"></i></a>
      <a href="#" id="menuIcon" data-target="slide-out" class="sidenav-trigger color-twitter<?php echo isset($hideMenu) ? ' hide': ''?>"><i class="fa fa-list-alt fa-4x"></i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="<?php echo url_for('tweets') ?>" class="color-black center<?php echo $active === 'tweets' ? ' active': ''; ?>"><i class="fa fa-home icon<?php echo $active === 'tweets' ? ' color-twitter': ''; ?>"></i> Home</a></li>
        <?php if(!Auth::isLoggedIn()): ?>
        <li><a href="<?php echo url_for('pages/about') ?>" class="color-black center<?php echo $active === 'about' ? ' active': ''; ?>"></i> About</a></li>
      <?php endif; ?>
      </ul>
      <?php if(Auth::isLoggedIn()): ?>
      <form action="<?php echo url_for('users/search/') ?>" method="get">
      <ul class="right hide-on-med-and-down">
        <li>
          <div class="input-field">
            <input id="search" name="user" type="text" placeholder="Search Twitter">
          </div>
        </li>
        <li>
          <button type="submit" class="btn no-shadow white" id="searchBtn"><i class="fa fa-search"></i></button>
        </li>
         <!-- <li class="drop"><a class="dropdown-trigger" data-target="#hello" href="#"><i class="fa fa-user"></i></a></li> -->
        <a href="<?php echo url_for('users/logout') ?>" class="color-twitter right">Logout</a>
        <li><a href="<?php echo url_for('tweets') ?>" class="btn no-shadow" id="tweetBtn">Tweet</a></li>

      </ul>
      </form>
      <?php endif; ?>
    </div>
  </div>
  <ul id="hello" class='dropdown-content'>
    <li><a href="#!">one</a></li>
    <li><a href="#!">two</a></li>
  </ul>
</nav>

<ul id="slide-out" class="sidenav">
    <li><div class="user-view bg-twitter">
      <div class="background">
      </div>
      <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-3x white-text"></i></a>
      <a href="<?php echo url_for('users/profile/') . $user->username ?>"><span class="white-text name"> <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></span></a>
      <a href="<?php echo url_for('users/profile/') . $user->username ?>"><span class="white-text email">@<?php echo $user->username; ?></span></a>
      <div class="card pt-0 no-shadow">
        <div class="card-action pt-0 pl-0 pr-0">
          <a href="<?php echo url_for('users/following/') . $user->username ?>"><span><?php echo $data['total-following']; ?></span> Following</a>
          <a href="<?php echo url_for('users/followers/') . $user->username ?>"><span class="center-align"><?php echo $data['total-follower']; ?></span> Followers</a>
        </div>
      </div>
    </div></li>
    <li><a href="<?php echo url_for('users/profile/') . h($user->username); ?>">Profile</a></li>
    <li><a href="<?php echo url_for('users/search'); ?>">Search</a></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect" href="<?php echo url_for('users/logout'); ?>">Logout</a></li>
  </ul>