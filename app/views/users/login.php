<?php require APPROOT . '/views/inc/header.php' ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main class="section">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 p-0">
          <div class="card">
            <div class="card-content">
              <h1 class="card-title mt-0">Log in to Twitter</h1>
              <?php if(isset($_SESSION['message'])): ?> 
              <p class="error"><?php echo get_and_clear_message(); ?></p>
              <?php endif; ?>
              <form method="post" action="<?php echo url_for('users/login'); ?>">
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?php echo $data['username']; ?>" id="username" name="username" type="text"<?php echo $data['username_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo $data['username_err']; ?></span>
                    <label for="username">Email or Username</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="password" name="password" type="password"<?php echo $data['password_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo $data['password_err']; ?></span>
                    <span class="helper-text">Password must be at least six(6) characters long and must contain one uppercase and number.</span>
                    <label for="password">Password</label>
                  </div>
                </div>
                <input type="submit" class="btn bg-twitter" value="Submit">
              </form>
            </div>
            <div class="card-action">
              <p>Need a twitter? <a href="<?php echo url_for('users/signup'); ?>">Sign Up</a></p>
            </div>
          </div>
      </div>
    </div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelector('.datepicker');
    var instances = M.Datepicker.init(elems);
  });
</script>
<?php require APPROOT . '/views/inc/footer.php' ?>