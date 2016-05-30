<?php

    function createpage($page){
        if($page === "SETUP"){
            loadpage("SETUP");
        }
        //TODO: Add other routes/pages
    }

    function loadpage($page){
        $page = strtolower($page);
        $file = $_SERVER['DOCUMENT_ROOT'] . "FlashMe/html/" . $page . ".html";
        if(file_exists($file)){
            include($file);
        }else{
            showerror("105");
        }
    }

    function showerror($error){
        $file = $_SERVER['DOCUMENT_ROOT'] . "FlashMe/html/error/" . $error . ".html";
        if(file_exists($file)){
            include($file);
        }
    }

?>
