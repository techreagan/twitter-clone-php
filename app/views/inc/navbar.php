<nav id="navbar" class="white navbar navbar-fixed">
  <div class="container<?php echo Auth::isLoggedIn() ? " main-container" : '' ?>">
    <div class="nav-wrapper">
      <a href="<?php echo url_for('tweets') ?>" class="brand-logo color-black center"><i class="fab fa-twitter color-twitter icon"></i></a>
      <a href="#" data-target="slide-out" class="sidenav-trigger color-twitter"><i class="fa fa-list-alt fa-4x"></i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="<?php echo url_for('tweets') ?>" class="color-black center<?php echo $active === 'tweets' ? ' active': ''; ?>"><i class="fa fa-home icon<?php echo $active === 'tweets' ? ' color-twitter': ''; ?>"></i> Home</a></li>
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
        <li><button type="button" class="btn no-shadow" id="tweetBtn">Tweet</button></li>

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
    <li><div class="user-view">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
      <a href="#name"><span class="white-text name">John Doe</span></a>
      <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>

