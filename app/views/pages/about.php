<?php require APPROOT . '/views/inc/header.php' ?>
<?php $hideMenu = 'true'; $active = 'about'; ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<main class="section pt-0">
  <div class="bg-twitter">
    <div class="container" id="about">
      <p class="mt-0">Twitter is</p>
      <p class="white-text">what’s happening in the world and what people are talking about right now.</p>
    </div>
    </div>
</main>
<script src="<?php echo url_for('js/jquery.js'); ?>"></script>
<script src="<?php echo url_for('js/materialize.min.js'); ?>"></script>
<?php require APPROOT . '/views/inc/footer.php' ?>