<?php

	function loadconfig(){
		$file = $_SERVER['DOCUMENT_ROOT'] . "FlashMe/config.ini";
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

	function saveconfig(){
		$data = array(
			"setup" => $_SESSION['setup'],
			"dbUsername" => $_SESSION['dbUsername'],
			"dbPassword" => $_SESSION['dbPassword'],
			"dbServerName" => $_SESSION['dbServerName']
		);
		writeconfig($data,"config.ini");
	}

	//writeconfig() and safefilerewrite() borrowed from Teoman Soygul
	//found on stackoverflow @ http://stackoverflow.com/questions/5695145/
	function writeconfig($array, $file){
    	$res = array();
    	foreach($array as $key => $val){
        	if(is_array($val)){
            	$res[] = "[$key]";
            	foreach($val as $skey => $sval){
					$res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
				}
        	}else{
				$res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
			}
    	}
    	safefilerewrite($file, implode("\r\n", $res));
	}

	function safefilerewrite($fileName, $dataToSave){
		if ($fp = fopen($fileName, 'w')){
	        $startTime = microtime(TRUE);
	        do{
				$canWrite = flock($fp, LOCK_EX);
	           //if lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
	           if(!$canWrite) usleep(round(rand(0, 100)*1000));
	        }while((!$canWrite)and((microtime(TRUE)-$startTime) < 5));
	        //file was locked so now we can store information
	        if($canWrite){
				fwrite($fp, $dataToSave);
	            flock($fp, LOCK_UN);
	        }
	        fclose($fp);
	    }
	}

?>
