<?php require APPROOT . '/views/inc/header.php' ?>
<main id="index">
  <div class="container">
    <div class="col m4 offset-m4 center-align">
      <h1><?php echo $data['title']; ?></h1>
      <a href="<?php echo url_for('/users/signup'); ?>" class="waves-effect waves-light btn blue">Sign Up</a>
      <a href="<?php echo url_for('/users/login'); ?>" class="waves-effect waves-light btn">Login</a>
    </div>
  </div>
</main>
<?php require APPROOT . '/views/inc/footer.php' ?>