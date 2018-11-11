<?php $tweets = $data['tweets']; $user = $data['user']; $like = $data['likes'];?>
<?php if(empty($tweets)): ?>
<p class="center-align">No tweets from you yet.</p>
<?php else: ?>
<?php foreach($tweets as $tweet): ?>
  <div class="card horizontal no-shadow">
    <div class="card-image">
      <a href="#" class="white-text"><span class="avatar"><i class="fa fa-user fa-2x circle"></i></span></a>
    </div>
    <div class="card-stacked">
      <div class="card-content">
      <p><a href="#"><span class="bold"><?php echo ucwords(h($tweet->firstname)) . ' ' . ucwords(h($tweet->lastname)); ?></span> <span class="color-grey">@<?php echo h($tweet->username); ?></span><small class="color-grey"> . </small><span class="date color-grey">Oct 4</span></a></p>
      <p class="tweet-body"><?php echo h($tweet->body); ?></p>
      </div>
      <div class="card-action">
      <a href="#!" class="color-grey likeBtn<?php echo $like->isLike($user->id, $tweet->tweet_id) ? ' liked': '' ?>" data-user="<?php echo $user->id; ?>" data-tweet="<?php echo $tweet->tweet_id; ?>"><i class="fa fa-heart"></i> <span><?php echo $like->getTotalLikes($tweet->tweet_id); ?></span></a>
      <?php if($tweet->user_id == $_SESSION['user_id']): ?>
      <a href="#!" class="color-grey deleteBtn" data-id="<?php echo $tweet->tweet_id; ?>"><i class="fa fa-times"></i></a>
      <?php endif; ?>
      </div>
    </div>
  </div>
<?php endforeach; endif;?>