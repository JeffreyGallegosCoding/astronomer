<?php require_once ("head-utils.php")?>
<?php require_once ("navbar.php");?>

<form>
	<form>
		<div class="container text-center" id="edit-profile">
			<h1>Edit your Profile</h1>
			<input type="text" class="form-control" id="profileName" name="Username" placeholder="New Username">
			<input type="email" class="form-control" id="profileEmail" name="Email" placeholder="Update Email">
			<input type="password" class="form-control" id="profilePassword" name="Password" placeholder="Enter New Password">
			<input type="password" class="form-control" id="profilePasswordConfirm" name="Password" placeholder="Confirm Password">
			<textarea class="form-control" id="profileBio" rows="3" placeholder="Enter Bio Here"></textarea>
			<br>
			<input class="btn" type="submit" value="Save your changes!">
		</div>
	</form>
</form>
