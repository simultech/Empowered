<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <div class="input text required form-group">
			<label for="UserUsername">Username</label>
			<input class="form-control" name="data[User][username]" maxlength="50" type="text" id="UserUsername" required="required" placeholder="Username"/>
		</div>
		<div class="input password required form-group">
			<label for="UserPassword">Password</label>
			<input class="form-control" name="data[User][password]" type="password" id="UserPassword" required="required" placeholder="Password" />
		</div>
    </fieldset>
    <button type="submit" class="btn btn-primary">Login</button>
<?php echo $this->Form->end(); ?>
</div>