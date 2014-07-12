<h2>Community: Discussion Group <?php echo $forum['Forum']['name']; ?></h2>
<div class="alert alert-info" role="alert">
<?php echo $forum['Forum']['description']; ?>
</div>
	<div class='row forumheader'>
		<div class='col-sm-9'>Topic</div>
		<div class='col-sm-3'>Last Post</div>
	</div>
<?php
	foreach($forumposts as $post) {
?>
	<div class='row forum'>
		<a href='/community/viewpost/<?php echo $post['Forumpost']['id']; ?>'>
		<div class='col-sm-9'><h3><?php echo $post['Forumpost']['subject']; ?></h3></div>
		<div class='col-sm-3' style='text-align:right;'><?php echo $forum['Forum']['updated']; ?></div>
		</a>
	</div>
<?php
	}
?>
<?php
	if($loggedIn) {
?>
	<h3>Create a new topic:</h3>
	<form method="POST">
	<div class="input password required form-group">
		<label for="UserIsCarer">Topic</label>
		<input class="form-control" name='subject' />
	</div>
	<div class="input password required form-group">	
		<label for="UserIsCarer">Content</label>
		<input class="form-control" name='text' />
	</div>
	<button type="submit" class="btn btn-primary">Add Topic</button>
	
	</form>
<?php
	} else {
?>
	<p>Please <a href='/users/login'>log in</a> to reply to this topic</p>
<?php
	}
?>