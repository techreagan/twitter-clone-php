<?php require APPROOT . '/views/inc/header.php' ?>
<?php $hideMenu = 'true'; $active = 'null'; ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main class="section">
  <div class="container auth">
    <div class="row">
      <div class="col s12 m7 p-0">
          <div class="card">
            <div class="card-content">
              <h1 class="card-title mt-0">Create an account</h1>
              <form method="post" id="form" action="<?php echo url_for('users/signup'); ?>">
                <div class="row mb-0">
                  <div class="input-field col s12 m6">
                    <input value="<?php echo h($data['firstName']); ?>" id="firstName" name="firstName" type="text"<?php echo $data['firstName_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['firstName_err']) ? h($data['firstName_err']) : 'This must be at least three(3) characters long' ?></span>
                    <label for="firstName">First Name</label>
                  </div>
                  <div class="input-field col s12 m6">
                    <input value="<?php echo h($data['lastName']); ?>" id="lastName" name="lastName" type="text"<?php echo $data['lastName_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['lastName_err']) ? h($data['lastName_err']) : 'This must be at least three(3) characters long' ?></span>
                    <label for="lastName">Last Name</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?php echo $data['email']; ?>" id="email" name="email" type="text"<?php echo $data['email_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['email_err']) ? h($data['email_err']) : 'This is invalid' ?></span>
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?php echo $data['username']; ?>" id="username" name="username" type="text"<?php echo $data['username_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['username_err']) ? h($data['username_err']) : 'This is invalid follow the helper' ?></span>
                    <span class="helper-text">Username must be at least three(3) characters long and must can contain one underscore and number.</span>
                    <label for="username">Username</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input value="<?php echo $data['dob']; ?>" id="dob" type="text" name="dob" class="datepicker<?php echo $data['dob_err'] != '' ? ' is-invalid' : ''; ?>">
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['dob_err']) ? h($data['dob_err']) : 'This is invalid'; ?></span>
                    <label for="dob">Date of birth</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="password" name="password" type="password"<?php echo $data['password_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['password_err']) ? h($data['password_err']) : 'This is invalid follow the helper'; ?></span>
                    <span class="helper-text">Password must be at least six(6) characters long and must contain one uppercase and number.</span>
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="confirmPassword" name="confirmPassword" type="password"<?php echo $data['confirmPassword_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                    <span class="helper-text invalid-feedback"><?php echo !empty($data['confirmPassword_err']) ? h($data['confirmPassword_err']) : 'Passwords must match'; ?></span>
                    <label for="confirmPassword">Confirm Password</label>
                  </div>
                </div>
                <input type="submit" name="submit" id="submit" class="btn bg-twitter rounded-border" value="Submit">
              </form>
            </div>
            <div class="card-action">
              <p>Already using twitter? <a href="<?php echo url_for('users/login'); ?>" class="color-twitter">Login</a></p>
            </div>
          </div>
      </div>
    </div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script src="<?php echo url_for('js/signup.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>