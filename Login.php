<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Validasi email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>alert('Format email tidak valid!'); window.location.href='Login.php';</script>";
		exit();
	}

	// Ambil domain
	$email_parts = explode('@', $email);
	if (count($email_parts) !== 2) {
		echo "<script>alert('Email tidak valid!'); window.location.href='Login.php';</script>";
		exit();
	}

	$domain = $email_parts[1];

	// Cek password sesuai dengan domain
	if ($password === $domain) {
		$_SESSION['user_email'] = $email;
		echo "<script>alert('Login berhasil!'); window.location.href='Form.php';</script>";
	} else {
		echo "<script>alert('Login gagal! Periksa email dan password Anda.'); window.location.href='Login.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Animated Login Form</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		}

		body,
		html {
			height: 100%;
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			font-family: Arial, sans-serif;
			background: #f4f4f4;
		}

		.container {
			width: 400px;
			padding: 2rem;
			background: #fff;
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			text-align: center;
		}

		.login-content img {
			width: 100px;
			margin-bottom: 10px;
		}

		.input-div {
			margin: 10px 0;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			display: flex;
			align-items: center;
			background: #f9f9f9;
		}

		.input {
			border: none;
			outline: none;
			background: none;
			padding: 10px;
			width: 100%;
		}

		.btn {
			width: 100%;
			padding: 10px;
			border: none;
			background: #4CAF50;
			color: white;
			border-radius: 5px;
			cursor: pointer;
			margin-top: 10px;
		}

		.btn:hover {
			background: #45a049;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="login-content">
			<form action="Login.php" method="POST">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<input type="email" name="email" class="input" placeholder="Email">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<input type="password" name="password" class="input" placeholder="Password">
					</div>
				</div>
				<input type="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
</body>
</html>
