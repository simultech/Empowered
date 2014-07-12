<h2>Join the Empowered community</h2>
<div class="alert alert-info" role="alert">Please provide us a few of your details.  These details will not be shared in any way, and only be used to customise your experience within the Empowered community to provide you with the best information.</div>
<div class="users form">
<?php $required = '<span class="label label-warning" style="float:right; display:block;">required</span>'; ?>

<?php echo $this->Form->create('User'); ?>
<div class='row'>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserUsername">Username </label>
			<input class="form-control" name="data[User][username]"  id="UserUsername" required="required" placeholder="Username" />
		</div>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserPassword">Password</label>
			<input class="form-control" name="data[User][password]" type="password" id="UserPassword" required="required" placeholder="Password" />
		</div>
	</div>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<label for="UserFirstname">First name</label>
			<input class="form-control" name="data[User][firstname]"  id="UserFirstname" placeholder="Firstname" />
		</div>
		<div class="input password required form-group">
			<label for="UserLastname">Last name</label>
			<input class="form-control" name="data[User][lastname]"  id="UserLastname" placeholder="Lastname" />
		</div>
	</div>
</div>
<div class='row'>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserPostcode">Postcode</label>
			<input class="form-control" name="data[User][postcode]"  id="UserPostcode" required="required" placeholder="Postcode" />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserState">State</label>
			<select class="form-control" name="data[User][state]"  id="UserState" required="required">
				<option value="qld">Queensland</option>
				<option value="nsw">New South Wales</option>
				<option value="vic">Victoria</option>
				<option value="sa">South Australia</option>
				<option value="wa">Western Australia</option>
				<option value="nt">Northern Territory</option>
				<option value="tas">Tasmania</option>
				<option value="act">Australian Capital Territory</option>
			</select>
		</div>
	</div>
	<div class='col-sm-6'>
		<div class="input password required form-group">
			<label for="UserAddress">Address</label>
			<input class="form-control" name="data[User][address]"  id="UserAddress" placeholder="Address" />
		</div>
	</div>
</div>
<div class='row'>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserAge">Age</label>
			<input class="form-control" name="data[User][age]"  id="UserAge" required="required" placeholder="Age" />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<?php echo $required; ?>
			<label for="UserGender">Gender</label>
			<select class="form-control" name="data[User][gender]"  id="UserGender" required="required">
				<option value="male">Male</option>
				<option value="female">Female</option>
				<option value="female">Other</option>
			</select>
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<label for="UserIsCarer">Are you a carer?</label>
			<input class="form-control" name="data[User][is_carer]" type="checkbox" id="UserIsCarer" />
		</div>
	</div>
	<div class='col-sm-3'>
		<div class="input password required form-group">
			<label for="UserIsDisabled">Do you require care?</label>
			<input class="form-control" name="data[User][is_disabled]" type="checkbox" id="UserIsDisabled" />
		</div>
	</div>
	<div class='col-sm-12'>
		<button type="submit" class="btn btn-primary">Register</button>
		<div style='height:50px;'></div>
	</div>
<?php echo $this->Form->end(); ?>
</div>