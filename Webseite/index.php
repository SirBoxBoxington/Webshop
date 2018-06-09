<html>
	<head>
		<title>Webshop</title>
		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- Initialize DB -->
        <?php include "php/initialize.php"; ?>
        <!-- Custom JS functions-->
        <script src="JS/nav.js"></script>
	</head>
		<div id="root">
			<div id="header">
				<?php include "php/header.php"; ?>
			</div>
			<div id="content">
				<?php include "content/" . $_SESSION['content'] . ".php"; ?>
			</div>
		</div>
	</body>
</html>