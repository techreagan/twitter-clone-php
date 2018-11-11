<?php 
  $user = $data['user']; 
  $tweets = $data['tweets']; 
  $user_tweets = $data['user_tweets'];
  $like = $data['likes'];
?>
<?php if(empty($tweets) && empty($user_tweets) ): ?>
<p class="center-align">Welcome to twitter, no tweets yet.</p>
<?php else: 
if (!$tweets) {
  $tweets = $user_tweets; 
} 
foreach($tweets as $tweet): ?>
<div class="card horizontal no-shadow">
  <div class="card-image">
    <a href="<?php echo url_for('users/profile/') . h(u($tweet->username)) ?>" class="white-text"><span class="avatar"><i class="fa fa-user fa-2x circle"></i></span></a>
  </div>
  <div class="card-stacked">
    <div class="card-content">
    <p><a href="<?php echo url_for('users/profile/') . h(u($tweet->username)) ?>"><span class="bold"><?php echo ucwords(h($tweet->firstname)) . ' ' . ucwords(h($tweet->lastname)); ?></span> <span class="color-grey">@<?php echo h($tweet->username); ?></span><small class="color-grey"> . </small><span class="date color-grey">Oct 4</span></a></p>
    <p class="tweet-body"><?php echo h($tweet->body); ?></p>
    </div>
    <div class="card-action">
      <a href="#!" class="color-grey likeBtn<?php echo $like->isLike($user->id, $tweet->id) ? ' liked': '' ?>" data-user="<?php echo $user->id; ?>" data-tweet="<?php echo $tweet->id; ?>"><i class="fa fa-heart"></i> <span><?php echo $like->getTotalLikes($tweet->id); ?></span></a>
      <?php if($tweet->user_id == $_SESSION['user_id']): ?>
      <a href="#!" class="color-grey deleteBtn" data-id="<?php echo $tweet->id; ?>"><i class="fa fa-times"></i></a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endforeach; endif;?>