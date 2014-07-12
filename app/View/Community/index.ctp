<h2>Community</h2>
	<div class='row forumheader'>
		<div class='col-sm-3'>Forum Name</div>
		<div class='col-sm-6'>Description</div>
		<div class='col-sm-3'>Last Updated</div>
	</div>
<?php
	foreach($forums as $forum) {
?>
	<div class='row forum'>
		<a href='/community/view/<?php echo $forum['Forum']['id']; ?>'>
		<div class='col-sm-3'><h3><?php echo $forum['Forum']['name']; ?></h3></div>
		<div class='col-sm-6'><?php echo $forum['Forum']['description']; ?></div>
		<div class='col-sm-3' style='text-align:right;'><?php echo $forum['Forum']['updated']; ?></div>
		</a>
	</div>
<?php
	}
?>