<?php include('includes/header.php'); ?>
<div class="wrap-reglogin">
	<h1>Log-in</h1><br>
	<form id='login' action='index.php' method='post' accept-charset='UTF-8'>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="login" class="login login-submit" value="login">
	</form>

	<div class="wrap-help">
		<?php if(isset($this->wrongpassword)) echo '<p style="color: red">' . $this->wrongpassword . '</p>'; ?>
		<a href="register.php">Register</a>
	</div>
</div>

<?php include('includes/footer.php'); ?>
