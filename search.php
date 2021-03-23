<!DOCTYPE HTML>
<html>
    <head>
    	<?php 
    	   $title = "Мои справочники";
    	   require_once "blocks/head.php";    	   
    	?>      	
    </head>
    <body>
        <?php require_once "blocks/header.php";?>
        <main>
        	<div id="mainpanel">
            	<h1>Результаты поиска</h1><br>                
                	<?php
                	if(isset($_POST["search_text"])){
                	    $search_text = $_POST["search_text"];
                	    if ($search_text == "") {
                	        ;
                	    }
                	    $search_array=search($search_text, $mantitles);
                	    foreach ($search_array as $manual => $charters){
                	        $manual_tab = getById($manual,"my_manuals");
                	        echo "<h3>".$manual_tab['title']."</h3>";
                	        foreach ($charters as $charter){
                	            echo "<hr>
                               <form name=\"searcharter".$charter['id']."\" action=\"manual.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"manualid\" value=\"$manual\">
                                    <input type=\"hidden\" name=\"search_text\" value=\"$search_text\">
                                    <input type=\"hidden\" name=\"manualtitle\" value=\"".$manual_tab['title']."\">
                                    <input type=\"hidden\" name=\"charterid\" value=\"".$charter['id']."\">
                                    <a onclick=\"document.searcharter".$charter['id'].".submit()\" href=\"#\">
                                        <p class=\"titles\">".$charter['title']."</p></a>
                                    Найдено - ".getCoincide($search_text, $charter['text_charter']).
                                    " совпадений с '<bo>$search_text</bo> '                                        
                               </form>";
                    	       }
                            }
                    	}
                	?>
            </div>
            <?php require_once "blocks/rightpanel.php";?>
        </main>        
        <?php require_once "blocks/footer.php";?>
        <?php require_once "blocks/feedback.php";?>        	
    </body>
</html>