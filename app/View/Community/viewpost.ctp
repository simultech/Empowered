<a href='/community/view/<?php echo $forum['Forum']['id']; ?>'><h2>Community: Discussion Group <?php echo $forum['Forum']['name']; ?></h2></a>
<h2><?php echo $post['Forumpost']['subject']; ?></h2>
	<h3>Topic: </h3>
	<div class='post'>
		<div class='meta'>
			by <?php echo $userlist[$post['Forumpost']['user_id']]; ?><br />
			on <?php echo date('Y-m-d \a\t ga',strtotime($post['Forumpost']['created'])); ?>
		</div>
		<p><?php echo $post['Forumpost']['text']; ?></p>
	</div>
	<h3>Replies: </h3>
<?php
	foreach($replies as $reply) {
?>
	<div class='post'>
		<div class='meta'>
			by <?php echo $userlist[$reply['Forumpost']['user_id']]; ?><br />
			on <?php echo date('Y-m-d \a\t ga',strtotime($reply['Forumpost']['created'])); ?>
		</div>
		<p><?php echo $reply['Forumpost']['text']; ?></p>
	</div>
<?php
		if(isset($reply['ingest'])) {
?>
	<div class='ingest'>
		<h4>Some additional information from <a href="<?php echo $reply['ingest']['backlink']; ?>"><?php echo $reply['ingest']['source']; ?></a></h4>
		<p><?php echo $reply['ingest']['content']; ?></p>
	</div>
<?php
		}
	}
	if(sizeOf($replies) == 0) {
		echo '<p style="text-align:center;">Nobody has replied to this topic yet</p>';
	}
?>
<?php
	if($loggedIn) {
?>
	<h3>Reply on this topic:</h3>
	<form method="POST">
	<div class="input password required form-group">
	<textarea class="form-control" name='text'></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Add Reply</button>
	
	</form>
<?php
	} else {
?>
	<p>Please <a href='/users/login'>log in</a> or <a href='/register'>register</a> to create a topic</p>
<?php
	}
?>