<?php

if (
	isset ($_POST['tambah'])
) {

	include "../db_conn.php";

	$nlengkap = $_POST['nlengkap'];
	$uname = $_POST['uname'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$data = "nlengkap=" . $nlengkap . "&uname=" . $uname . "&email=" . $email;

	if (empty ($nlengkap)) {		$em = "Nama Lengkap Dibutuhkan";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty ($uname)) {
		$em = "Nama Dibutuhkan";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty ($email)) {
		$em = "Email Dibutuhkan";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else if (empty ($pass)) {
		$em = "Katasandi Dibutuhkan";
		header("Location: ../signup.php?error=$em&$data");
		exit;
	} else {
		// hashing the password
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		if (isset ($_FILES['image']['name']) and !empty ($_FILES['image']['name'])) {


			$img_name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$error = $_FILES['image']['error'];

			if ($error === 0) {
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_to_lc = strtolower($img_ex);

				$allowed_exs = array('jpg', 'jpeg', 'png');
				if (in_array($img_ex_to_lc, $allowed_exs)) {
					$new_img_name = uniqid($uname, true) . '.' . $img_ex_to_lc;
					$img_upload_path = '../image_profil/' . $new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);

					// Insert into Database
					$sql = "INSERT INTO user(username, password, email, namalengkap, alamat, image ) 
    	        VALUES(?,?,?,?,?,?)";
					$stmt = $conn->prepare($sql);
					$stmt->execute([$uname, $pass, $email, $nlengkap, $alamat, $new_img_name]);
					echo "<script> 
		alert('Pendaftaran Akun Berhasil');
		location.href='../login.php';
		exit;
		</script>";
				} else {
					$em = "Anda tidak dapat mengunggah file jenis ini";
					header("Location: ../signup.php?error=$em&$data");
					exit;
				}
			} else {
				$em = "terjadi kesalahan yang tidak diketahui!";
				header("Location: ../signup.php?error=$em&$data");
				exit;
			}


		} else {
			$sql = "INSERT INTO user(username, password, email, namalengkap, alamat, image ) 
    	        VALUES(?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$uname, $pass, $email, $nlengkap, $alamat, $new_img_name]);

			echo "<script> 
		alert('Pendaftaran Akun Berhasil');
		location.href='../login.php';
		exit;
		</script>";
		}
	}


} else {
	header("Location: ../index.php?error=error");
	exit;
}