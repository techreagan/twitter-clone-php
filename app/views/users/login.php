<?php require APPROOT . '/views/inc/header.php' ?>
<?php $hideMenu = 'true'; $active = 'null'?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main class="section">
  <div class="container auth">
    <div class="row">
      <div class="col s12 m12 p-0">
          <div class="card">
            <div class="card-content">
              <div class="row">
                <div class="col l5 m7 s12 offset-l1 offset-m1">
                  <h1 class="card-title mt-0">Log in to Twitter</h1>
                  <?php if(isset($_SESSION['message'])): ?> 
                  <p class="error"><?php echo get_and_clear_message(); ?></p>
                  <?php endif; ?>
                  <form method="post" action="<?php echo url_for('users/login'); ?>">
                    <div class="row mb-0">
                      <div class="input-field col s12">
                        <input value="<?php echo $data['username']; ?>" id="username" name="username" type="text"<?php echo $data['username_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                        <span class="helper-text invalid-feedback"><?php echo !empty($data['username_err']) ? $data['username_err'] : 'Please enter email or username'; ?></span>
                        <label for="username">Email or Username</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="password" name="password" type="password"<?php echo $data['password_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                        <span class="helper-text invalid-feedback"><?php echo !empty($data['password_err']) ? $data['password_err'] : 'Please enter password'; ?></span>
                        <label for="password">Password</label>
                      </div>
                    </div>
                    <input type="submit" class="btn bg-twitter rounded-border" value="Submit">
                  </form>
                </div>
              </div>
            </div>
            <div class="card-action">
              <div class="row mt-0 mb-0">
                <div class="col l5 m7 s12 offset-l1 offset-m1">
                  <p>Need a twitter? <a href="<?php echo url_for('users/signup'); ?>" class="color-twitter">Sign Up</a></p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script src="<?php echo url_for('js/login.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>