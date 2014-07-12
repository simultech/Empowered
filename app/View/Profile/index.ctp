<h2>Edit Your Profile (<?php echo $user['username']; ?>)</h2>
<div class="alert alert-info" role="alert">Please provide us a few of your details.  These details will not be shared in any way, and only be used to customise your experience within the Empowered community to provide you with the best information.</div>
<div class="users form">
<?php $required = '<span class="label label-warning" style="float:right; display:block;">required</span>'; ?>

<?php echo $this->Form->create('User'); ?>
<div class='row'>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserUsername">Username </label>
			<input class="form-control" name="data[User][username]"  id="UserUsername" required="required" placeholder="Username" disabled="disabled" value="<?php echo $profile['User']['username']; ?>" />
		</div>
		<div class="input password required form-group">
			<label for="UserPassword">New Password</label>
			<input class="form-control" name="data[User][password]" type="password" id="UserPassword" placeholder="Password" value="" />
		</div>
	</div>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<label for="UserFirstname">First name</label>
			<input class="form-control" name="data[User][firstname]"  id="UserFirstname" placeholder="Firstname" value="<?php echo $profile['User']['firstname']; ?>" />
		</div>
		<div class="input password required form-group">
			<label for="UserLastname">Last name</label>
			<input class="form-control" name="data[User][lastname]"  id="UserLastname" placeholder="Lastname" value="<?php echo $profile['User']['lastname']; ?>" />
		</div>
	</div>
</div>
<div class='row'>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserPostcode">Postcode</label>
			<input class="form-control" name="data[User][postcode]"  id="UserPostcode" required="required" placeholder="Postcode" value="<?php echo $profile['User']['postcode']; ?>" />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserState">State</label>
			<select class="form-control" name="data[User][state]"  id="UserState" required="required">
				<?php
					$state_selection = array('qld'=>'','nsw'=>'','vic'=>'','sa'=>'','wa'=>'','nt'=>'','tas'=>'','act'=>'');
					$state_selection[$profile['User']['state']] = 'selected="selected"';
				?>
				<option value="qld" <?php echo $state_selection['qld']; ?>>Queensland</option>
				<option value="nsw" <?php echo $state_selection['nsw']; ?>>New South Wales</option>
				<option value="vic" <?php echo $state_selection['vic']; ?>>Victoria</option>
				<option value="sa" <?php echo $state_selection['sa']; ?>>South Australia</option>
				<option value="wa" <?php echo $state_selection['wa']; ?>>Western Australia</option>
				<option value="nt" <?php echo $state_selection['nt']; ?>>Northern Territory</option>
				<option value="tas" <?php echo $state_selection['tas']; ?>>Tasmania</option>
				<option value="act" <?php echo $state_selection['act']; ?>>Australian Capital Territory</option>
			</select>
		</div>
	</div>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<label for="UserAddress">Address</label>
			<input class="form-control" name="data[User][address]"  id="UserAddress" placeholder="Address" value="<?php echo $profile['User']['address']; ?>" />
		</div>
	</div>
</div>
<div class='row'>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserAge">Age</label>
			<input class="form-control" name="data[User][age]"  id="UserAge" required="required" placeholder="Age" value="<?php echo $profile['User']['age']; ?>" />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserGender">Gender</label>
			<select class="form-control" name="data[User][gender]"  id="UserGender" required="required">
				<?php
					$gender_selection = array('male'=>'','female'=>'','other'=>'');
					$gender_selection[$profile['User']['gender']] = 'selected="selected"';
				?>
				<option value="male" <?php echo $gender_selection['male']; ?>>Male</option>
				<option value="female" <?php echo $gender_selection['female']; ?>>Female</option>
				<option value="other" <?php echo $gender_selection['other']; ?>>Other</option>
			</select>
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php
				$carer_checked = '';
				if($profile['User']['is_carer']) {
					$carer_checked = 'checked="checked"';
				}
			?>
			<label for="UserIsCarer">Are you a carer?</label>
			<input class="form-control" name="data[User][is_carer]" type="checkbox" id="UserIsCarer" <?php echo $carer_checked; ?> />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php
				$disabled_checked = '';
				if($profile['User']['is_disabled']) {
					$disabled_checked = 'checked="checked"';
				}
			?>
			<label for="UserIsDisabled">Do you require care?</label>
			<input class="form-control" name="data[User][is_disabled]" type="checkbox" id="UserIsDisabled" <?php echo $disabled_checked; ?> />
		</div>
	</div>
	<div class='col-sm-12'>
		<button type="submit" class="btn btn-primary">Update Profile</button>
		<div style='height:50px;'></div>
	</div>
<?php echo $this->Form->end(); ?>
</div>