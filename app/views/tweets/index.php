<?php require APPROOT . '/views/inc/header.php' ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<?php $user = $data['user']; ?>
<main>
  <div class="main-container">
    <div class="row">
      <div class="col m3">
        <div class="card card-profile">
          <div class="bg-twitter">
            <div class="img">
              <!-- <img src="<?php echo h($user->profileimg) ?>" alt="<?php echo $user->username . '-avatar' ?>"> -->
              <i class="fa fa-user-tie fa-3x"></i>
            </div>
          </div>
          <div class="card-content">
            <p>
              <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?>
              <span><?php echo '@' . h($user->username); ?>
            </p>
          </div>
          <div class="card-action">
            <a href="#">Tweet</a>
            <a href="#">Following</a>
            <a href="#">Followers</a>
          </div>
        </div>
      </div>
      <div class="col m6">
        hello
      </div>
      <div class="col m3">
        hello
      </div>
    <div>
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>