<?php
	
	function LoadConfig(){
		$file = $_SERVER['DOCUMENT_ROOT'] . "FlashMe/php/config.ini";
		if(file_exists($file)){
			$conf = parse_ini_file($file);
			$_SESSION['setup'] = $conf['setup'];
			$_SESSION['dbUsername'] = $conf['dbUsername'];
			$_SESSION['dbPassword'] = $conf['dbPassword'];
			$_SESSION['dbServerName'] = $conf['dbServerName'];
			return true;
		}else{
			return false;
		}	
	}

?>