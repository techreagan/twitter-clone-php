<?php require APPROOT . '/views/inc/header.php' ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main>
  <div class="container">
    <div class="row">
      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <h1 class="card-title">Log in to Twitter</h1>
            <form method="post" action="<?php echo url_for('users/signup'); ?>">
              <div class="row">
                <div class="input-field col s12">
                  <input value="" id="disabled" type="text" class="validate">
                  <span>hello world</span>
                  <label for="disabled">Disabled</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="password" type="password" class="validate">
                  <label for="password">Password</label>
                </div>
              </div>
            </form>
          </div>
          <div class="card-action">
            <a href="#">This is a link</a>
            <a href="#">This is a link</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>