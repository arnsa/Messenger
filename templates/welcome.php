<?php include('includes/header.php'); ?>

	<header>
		<h1>Messenger</h1>

	</header>
	<div class="wrap-msg">
		<ul>
			<?php foreach($this->messages as $msg): ?>
				<li class="msg"><span><?php echo $msg->time; ?> - </span><strong><?php echo $msg->username; ?>:</strong> <?php echo $msg->message; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div id="input">
		<form method="post" action="index.php">
			<input type="text" name="message" placeholder="Enter A Message" />
		</form>
	</div>
	<div class="lout">
		<form id='logout' action='index.php' method='post' accept-charset='UTF-8'>
			<input type="submit" name="logout" value="Log out" />
		</form>
	</div>

<?php include('includes/footer.php'); ?>