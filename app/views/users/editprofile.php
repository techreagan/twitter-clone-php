<?php require APPROOT . '/views/inc/header.php' ?>
<?php $user = $data['user'];?>
<?php //var_dump($user) ?>
<?php $active = 'user_tweets'; require APPROOT . '/views/inc/navbar.php' ?>
<main class="section">
  <div class="main-container container">
    <div class="row">
      <div class="col xl3 l4 s12 pl-0" id="user-profile">
        <div class="card card-profile no-shadow">
            <div class="bg-twitter">
              <div class="img">
                <!-- <img src="<?php echo h($user->profileimg) ?>" alt="<?php echo $user->username . '-avatar' ?>"> -->
                <a href="<?php echo url_for('users/profile/') . $user->username ?>"><i class="fa fa-user fa-3x white-text"></i></a>
              </div>
            </div>
            <div class="card-content white">
              <p><a href="<?php echo url_for('users/profile/') . $user->username ?>">
                <?php echo h(ucwords($user->firstname)) . ' ' . h(ucwords($user->lastname)); ?></a>
                <span><?php echo '@' . h($user->username); ?>
              </p>
            </div>
            
          </div>
        </div>
      <div class="col xl6 l8 m12 s12 pl-0">
        <div class="card no-shadow section personalInfo pt-0">
          <div class="card-content">
          <h5>Personal Information</h5>
            <form method="post" action="<?php echo url_for('users/editprofile/') . h(u($user->username)); ?>" id="personalInfoForm">
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
                  <textarea id="bio" name="bio" class="materialize-textarea<?php echo $data['bio_err'] != '' ? ' is-invalid' : ''; ?>"><?php echo $data['bio']; ?></textarea>
                  <span class="helper-text invalid-feedback"><?php echo !empty($data['bio_err']) ? h($data['bio_err']) : 'This is invalid'; ?></span>
                  <label for="bio">Bio</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input value="<?php echo $data['dob']; ?>" id="dob" type="text" name="dob" class="datepicker<?php echo $data['dob_err'] != '' ? ' is-invalid' : ''; ?>">
                  <span class="helper-text invalid-feedback"><?php echo !empty($data['dob_err']) ? h($data['dob_err']) : 'This is invalid'; ?></span>
                  <label for="dob">Date of birth</label>
                </div>
              </div>  
            
              <input type="submit" name="update" class="btn bg-twitter" value="Update">
            </form>
          </div>
        </div>
        <div class="card no-shadow section">
          <div class="card-content pt-0">
            <h5>Change Password</h5>
            <form method="post" action="<?php echo url_for('users/editprofile/') . h(u($user->username)); ?>" id="changePasswordForm">
              <div class="row">
                <div class="input-field col s12">
                  <input id="currentPassword" name="currentPassword" type="password"<?php echo $data['currentPassword_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                  <span class="helper-text invalid-feedback"><?php echo !empty($data['currentPassword_err']) ? h($data['currentPassword_err']) : ' This is invalid'; ?></span>
                  <!-- <span class="helper-text">Password must be at least six(6) characters long and must contain one uppercase and number.</span> -->
                  <label for="currentPassword">Current Password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="password" name="password" type="password"<?php echo $data['password_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                  <span class="helper-text invalid-feedback"><?php echo !empty($data['password_err']) ? h($data['password_err']) : ' This is invalid, follow the helper'; ?></span>
                  <span class="helper-text">Password must be at least six(6) characters long and must contain one uppercase and number.</span>
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="confirmPassword" name="confirmPassword" type="password"<?php echo $data['confirmPassword_err'] != '' ? ' class="is-invalid"' : ''; ?>>
                  <span class="helper-text invalid-feedback"><?php echo !empty($data['confirmPassword_err']) ? $data['confirmPassword_err'] : 'Password must match'; ?></span>
                  <label for="confirmPassword">Confirm Password</label>
                </div>
              </div>
              <input type="submit" name="changePassword" class="btn bg-twitter" value="Change Password">
            </form>
          </div>
        </div>
      </div>
    <div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<script src="<?php echo url_for('js/editprofile.js'); ?>"></script>
<?php if(isset($_SESSION['message']) && ($_SESSION['message'] == 'Personal Information Updated')): ?>
<script>
M.toast({html: '<?php echo get_and_clear_message() ?>', classes: 'green white-text'})
</script>
<?php endif; ?>
<?php if(isset($_SESSION['message']) && ($_SESSION['message'] == 'Password Updated Successfully')): ?>
<script>
M.toast({html: '<?php echo get_and_clear_message() ?>', classes: 'green white-text'})
</script>
<?php endif; ?>
<?php if(isset($_SESSION['message']) && ($_SESSION['message'] == 'Failed to change password')): ?>
<script>
M.toast({html: '<?php echo get_and_clear_message() ?>', classes: 'red white-text'})
</script>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>