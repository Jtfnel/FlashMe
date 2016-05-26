<?php
    
    require "/php/word.php";
    require "/php/settings.php";

    session_start();

    if((!loadConfig()) || (!$_SESSION['setup'])){
        $page = "SETUP";
    }else{
        if(isset($_GET['page'])){
            $page = strtoupper($_GET['page']);
        }else{
            $page = "WORD";
        }
    }

?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Meta Tags -->
    	<meta charset="utf-8" />
    	<meta name="keywords" content="flashcard, vocabulary, creator, maker, language, lang, vocab, flash, me" />
    	<meta name="description" content="FlashMe is a flashcard app" />
    	<meta name="author" content="Cobblestone Bridge" />

    	<title>FlashMe</title>

    	<!-- CSS Links -->
    	<link rel="stylesheet" href="css/site.css" />
  	</head>
    <body>
    <?php



    ?>
    </body>
</html>