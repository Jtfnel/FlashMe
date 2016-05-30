<?php

	require "/php/settings.php";

	session_start();
	loadconfig();

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
			$url = "Location: index.php?page=error&e=100";
		}

		$sql = "CREATE DATABASE flashMe CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		if(mysqli_query($connection,$sql)){
			$_SESSION['setup'] = "0";
			$_SESSION['dbUsername'] = $username;
			$_SESSION['dbPassword'] = $password;
			$_SESSION['dbServerName'] = $server;
			saveconfig();
			mysqli_close($connection);

			$connection = mysqli_connect($server,$username,$password,"flashMe");
			if(!$connection){
				$url = "Location: index.php?page=error&e=100";
			}
			/*
				There are 2 words in the english language that are to long to be
				entered into engword.
			*/
			$sql = "CREATE TABLE german (
				id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				word VARCHAR(100) NOT NULL,
				plural VARCHAR(100),
				gender VARCHAR(5) DEFAULT 'NONE',
				type VARCHAR(20) NOT NULL,
				engword VARCHAR(250) NOT NULL
			)";

			if(mysqli_query($connection,$sql)){
				$url = "Location: index.php?page=word";
			}else{
				$url = "Location: index.php?page=error&e=103";
			}
			mysqli_close($connection);
		}else{
			$url = "Location: index.php?page=error&e=101";
		}
	}else{
		$url = "Location: index.php?page=error&e=102";
	}

	header($url);

?>
