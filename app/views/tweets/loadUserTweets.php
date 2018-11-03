<?php $tweets = $data['tweets']; ?>
<?php foreach($tweets as $tweet): ?>
  <div class="card horizontal no-shadow">
    <div class="card-image">
      <a href="#" class="white-text"><span class="avatar"><i class="fa fa-user fa-2x circle"></i></span></a>
    </div>
    <div class="card-stacked">
      <div class="card-content">
      <p><a href="#"><span class="bold"><?php echo ucwords(h($tweet->firstname)) . ' ' . ucwords(h($tweet->lastname)); ?></span> <span class="color-grey">@<?php echo h($tweet->username); ?></span><small class="color-grey"> . </small><span class="date color-grey">Oct 4</span></a></p>
      <p class="tweet-body"><?php echo $tweet->body; ?></p>
      </div>
      <div class="card-action">
        <a href="#" class="color-grey"><i class="fa fa-heart"></i> <span>234</span></a>
      </div>
    </div>
  </div>
<?php endforeach;?>