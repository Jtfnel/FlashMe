<?php

    require "/php/settings.php";

    session_start();
    loadconfig();

    if($_SESSION['setup'] == "1"){
		$flag = false;
	}else{
		$flag = true;
	}

    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];
        $flag = true;
    }else{
        $flag = false;
    }

    if(isset($_POST['word'])){
        $word = $_POST['word'];
        $flag = true;
    }else{
        $flag = false;
    }

    if(isset($_POST['plural'])){
        $plural = $_POST['plural'];
        $flag = true;
    }else{
        $flag = false;
    }

    if(isset($_POST['english'])){
        $english = $_POST['english'];
        $flag = true;
    }else{
        $flag = false;
    }

    if(isset($_POST['type'])){
        $type = $_POST['type'];
        $flag = true;
    }else{
        $flag = false;
    }

    if($flag){
        $username = $_SESSION['dbUsername'];
        $password = $_SESSION['dbPassword'];
        $server = $_SESSION['dbServerName'];
        $connection = mysqli_connect($server,$username,$password,"flashMe");
		if(!$connection){
			$url = "Location: index.php?page=error&e=100";
		}

        $sql = "INSERT INTO german (word, plural, gender, type, engword)
        VALUES ('$word', '$plural', '$gender', '$type', '$engword')";
        
        if(mysqli_query($connection,$sql)){

        }else{
            $url = "Location: index.php?page=error&e=104";
        }
    }

?>
