<?php include('includes/header.php'); ?>

<?php if(!$this->registered): ?>
	<div class="wrap-reglogin">
		<h1>Register</h1><br>
		<form id='register' action='register.php' method='post' accept-charset='UTF-8'>
			<input type='text' name='name' id='name' placeholder="Name" maxlength="50" />
			<br>
			<input type='text' name='second_name' id='second_name' placeholder="Second name" maxlength="50" />
			<br>
			<input type='text' name='username' id='username' placeholder="Username" maxlength="50" />
			<br>
			<input type='text' name='email' id='email' placeholder="Email" maxlength="50" />
			<br>
			<input type='password' name='password' id='password' placeholder="Password" maxlength="50" />
			<br>
			<input type='password' name='repeat_password' id='repeat_password' placeholder="Repeat password" maxlength="50" />
			<br>
			<input type='submit' name='register' class="login login-submit" value='Submit' />
			<div class="wrap-help">
				<?php if(isset($this->registrationMsg)) echo '<p style="color: red">' . $this->registrationMsg . '</p>'; ?>
				<a href="index.php">Home</a>
			</div>
		</form>
	</div>
<?php else:
	echo '<p>' . $this->registrationMsg . '</p>';
endif;
?>

<?php include('includes/footer.php'); ?>