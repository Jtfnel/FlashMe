<?php

	require "/php/settings.php";

	loadconfig();
	session_start();

	if($_SESSION['setup'] == "1"){
		$flag = false;
	}else{
		$flag = true;
	}

	if(isset($_POST['username'])){
		$username = $_POST['username'];
	}else{
		$flag = false;
	}

	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}else{
		$flag = false;
	}

	if(isset($_POST['servername'])){
		$server = $_POST['servername'];
	}else{
		$flag = false;
	}

	if($flag){
		$connection = mysqli_connect($server,$username,$password);
		if(!$connection){
			die("Connection Error: " . mysqli_connect_error());
			$url = "Location: index.php?page=error&e=100";
		}

		$sql = "CREATE DATABASE fmGerman CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		if(mysqli_query($connection,$sql)){
			$_SESSION['setup'] = "0";
			$_SESSION['dbUsername'] = $username;
			$_SESSION['dbPassword'] = $password;
			$_SESSION['dbServerName'] = $server;
			saveconfig();
			echo mysqli_error();
			$url = "Location: index.php?page=word";
		}else{
			$url = "Location: index.php?page=error&e=101";
		}
		mysqli_close($connection);
	}else{
		$url = "Location: index.php?page=error&e=102";
	}

	header($url);

?>
