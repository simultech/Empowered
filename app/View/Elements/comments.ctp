<?php
	$length = 12;
	$rand = $sig;
	$randsend = $rand.'_send';
?>
<div class='comments'>
	<button class='btn btn-default btn-sm' id='<?php echo $rand; ?>'>Comments</button>
	<p class='count'><span class='cc'><?php echo sizeOf($comments); ?></span> comments <i class='fa fa-comments'></i></p>
</div>
<div class="commentarea">
	<?php
	foreach($comments as $comment) {
		echo '<div class="com">';
		echo '<p>'.$comment['Comment']['comment'].'</p>';
		echo '<p class="commeta">Posted by '.$comment['Comment']['user_id'].' on '.date('Y-m-d ga',strtotime($comment['Comment']['created'])).'</p>';
		echo '</div>';
	}
	?>
	<div class="extracomments"></div>
	<div class="newcomment">
		<?php
		if(isset($loggedIn)) {
		?>
		<textarea class="form-control"></textarea>
		<button type="submit" class="btn btn-primary btn-sm" id='<?php echo $randsend; ?>'>Add Comment</button>
		<?php
		} else {
		?>
		<p>Please <a href="/users/login">log in</a> to comment</p>
		<?php
		}
		?>
	</div>
</div>
<script type='text/javascript'>
	$('#<?php echo $rand; ?>').click(function() {
		var item = $(this).parent().parent();
		if(item.hasClass('showing')) {
			item.removeClass('showing');
			$(this).text('Comments');
		} else {
			item.addClass('showing');
			$(this).text('Hide comments');
		}
	});
	$('#<?php echo $randsend; ?>').click(function() {
		var comment_text = $(this).parent().find('textarea').val();
		$.post( "/information/savecomment", { text: comment_text, sig: "<?php echo $rand; ?>" })
		.done(function( data ) {
			var comarea = $('#<?php echo $randsend; ?>').parent().parent();
			var span = $('#<?php echo $randsend; ?>').parent().parent().parent().find('.cc');
			comarea.find('.extracomments').append(data);
			var curcom = parseInt(span.text());
			span.text((curcom+1)+"");
			$('#<?php echo $randsend; ?>').parent().parent().find('textarea').val('');
			console.log($(this));
		});
	});
</script>