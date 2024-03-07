<?php

if (
	isset($_POST['nlengkap']) &&
	isset($_POST['uname']) &&
	isset($_POST['alamat']) &&
	isset($_POST['email']) &&
	isset($_POST['pass'])
) {

	include "../db_conn.php";

	$nlengkap = $_POST['nlengkap'];
	$uname = $_POST['uname'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$data = "nlengkap=" . $nlengkap . "&uname=" . $uname . "&alamat=" . $alamat . "&email=" . $email;

	if (empty($nlengkap)) {
		$em = "Full name is required";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty($uname)) {
		$em = "User name is required";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty($email)) {
		$em = "Email is required";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty($pass)) {
		$em = "Password is required";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else {

		// hashing the password
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO user(username, password, email, namalengkap, alamat ) 
    	        VALUES(?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $pass, $email, $nlengkap, $alamat]);
		echo "<script> 
		alert('Pendaftaran Akun Berhasil');
		location.href='../login.php';
		exit;
		</script>";

	}


} else {
	header("Location: ../index.php?error=error");
	exit;
}