<?php

    require "/php/word.php";
    require "/php/settings.php";
    require "/php/page.php";

    session_start();

    if((!loadconfig()) || ($_SESSION['setup'] == "1")){
        $page = "SETUP";
    }else if($page == "ERROR"){
        if(isset($_GET['e'])){
            $error = $_GET['e'];
            showerror($error);
        }else{
            showerror("105");
        }
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
            if($page === "WORD"){
                showWord();
            }else{
                createpage($page);
            }
        ?>
    </body>
</html>
