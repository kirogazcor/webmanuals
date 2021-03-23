<!DOCTYPE HTML>
<html>
    <head>
    	<?php
           if(isset($_POST["manualtitle"]))
           {
    	       $title = $_POST["manualtitle"];
           }
    	   require_once "blocks/head.php";
    	   if(isset($_POST["manualid"]))
    	   {
    	       $manualid = $_POST["manualid"];
    	       $manual = getById($manualid,"my_manuals");
    	       $titles = getTitles($manual["name"]);
    	   }
    	   if(isset($_POST["search_text"]))
    	   {
    	       $search_text = $_POST["search_text"];
    	   }
    	   else $search_text = "";
    	?>    	
    </head>
    <body>
        <?php require_once "blocks/header.php";?>
        <main>
        	<div id="contents" class="leftpanel">
        		<h3><?=$title?></h3>
        			<?php
        			     foreach ($titles as $value) {
        			         echo "<hr>
                               <form name=\"charterform$value[id]\" action=\"manual.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"manualid\" value=\"$manualid\">
                                    <input type=\"hidden\" name=\"manualtitle\" value=\"$title\">
                                    <input type=\"hidden\" name=\"charterid\" value=\"$value[id]\">
                                    <a onclick=\"document.charterform$value[id].submit()\" href=\"#\">
                                        <p class=\"titles\">$value[title]</p></a>
                               </form>";
        			     }
        			?>        		
        	</div>
        	<div id="scroll_contents" class="leftpanel">
        		<h3><?=$title?></h3>
        			<?php
        			     foreach ($titles as $value) {
        			         echo "<hr>
                               <form name=\"charterscroll$value[id]\" action=\"manual.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"manualid\" value=\"$manualid\">
                                    <input type=\"hidden\" name=\"manualtitle\" value=\"$title\">
                                    <input type=\"hidden\" name=\"charterid\" value=\"$value[id]\">
                                    <a onclick=\"document.charterscroll$value[id].submit()\" href=\"#\">
                                        <p class=\"titles\">$value[title]</p></a>
                               </form>";
        			     }
        			?>        		
        	</div>
        	<script src="js/leftpanelscript.js"></script>
        	<div id="centerpanel">
            	<?php 
            	    if(isset($_POST["charterid"]))
            	    {
            	        $charterid=$_POST["charterid"];
            	        $text=getById($charterid,$manual["name"])["text_charter"];
            	    }
            	    else $text=$manual["intro"];            	
            	    echo formatTextManual($text, $search_text);
                ?>
            </div>
            <?php require_once "blocks/rightpanel.php";?>
        </main>        
        <?php require_once "blocks/footer.php";?>
        <?php require_once "blocks/feedback.php";?>
        	
    </body>
</html>