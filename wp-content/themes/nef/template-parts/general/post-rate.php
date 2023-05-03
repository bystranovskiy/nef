<?php
$post_id = $args['post_id'];
$post_rated = $args['post_rated'];
$like = get_field('like', $post_id);
$dislike = get_field('dislike', $post_id);
?>
<div class="post-rate<?php echo $_COOKIE['post-rated'] || $post_rated ? ' post-rated': '';?>" data-post-id="<?php echo $post_id; ?>">
    <div class="post-rate-item<?php echo !$like ? ' no-rate' : ''; ?>"><span class="icon-like brd circle-elem" data-action="like"></span> <?php echo $like; ?></div>
    <div class="post-rate-item<?php echo !$dislike ? ' no-rate' : ''; ?>"><span class="icon-dislike brd circle-elem" data-action="dislike"></span> <?php echo $dislike; ?></div>
</div>