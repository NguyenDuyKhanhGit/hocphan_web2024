<?php
include_once 'controller/adminlogin.php';
?>

<?php
$class = new adminlogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$adminUser = $_POST['adminUser'];
	$adminPass = $_POST['adminPass'];
	$adminName = $_POST['adminName'];
	$adminEmail = $_POST['adminEmail'];
	$adminAddress = $_POST['adminAddress'];
	$adminPhone = $_POST['adminPhone'];

	$register_check = $class->register_admin($adminUser, $adminPass,$adminName, $adminEmail, $adminAddress, $adminPhone);
}
?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="public/css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="register.php" method="post">
				<h1>Đăng ký</h1>
				<span><?php
						if (isset($register_check)) {
							echo $register_check;
						}
						?></span>
				<div>
					<input type="text" placeholder="Username" required="" name="adminUser" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="adminPass" />
				</div>
				<div>
					<input type="text" placeholder="Email" required="" name="adminEmail" />
				</div>
				<div>
					<input type="text" placeholder="Name" required="" name="adminName" />
				</div>
				<div>
					<input type="text" placeholder="Address" required="" name="adminAddress" />
				</div>
				<div>
					<input type="text" placeholder="Phone" required="" name="adminPhone" />
				</div>
				<div>
					<input type="submit" value="Đăng ký" />
					<a href="login.php">Đăng nhập</a>
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">Training with website</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>