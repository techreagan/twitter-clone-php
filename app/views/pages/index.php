<?php require APPROOT . '/views/inc/header.php' ?>
<main id="index">
  <div class="container">
    <div class="row">
      <div class="col m6 offset-m3">
        <i class="fab fa-twitter fa-3x color-twitter"></i>
        <h1>See what’s happening in the world right now</h1>
        <p>Join Twitter today.</p>
        <a href="<?php echo url_for('/users/signup'); ?>" class="signup no-shadow waves-effect waves-light btn blue">Sign Up</a>
        <a href="<?php echo url_for('/users/login'); ?>" class="login no-shadow waves-effect waves-light btn color-twitter">Login</a>
      </div>
    </div>
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>