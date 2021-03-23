<header>
	<a href="index.php">
    	<img alt="Логотип" src="img/logo.png" id="logo">   
    </a>    
    <div id="manuals"><li><a>Учебники</a></li>
    	<ul class="menu">
    		<?php
        	     foreach ($mantitles as $value) {
        	         echo "<hr>
                           <form name=\"myform$value[id]\" action=\"manual.php\" method=\"POST\">
                                <input type=\"hidden\" name=\"manualid\" value=\"$value[id]\">
                                <input type=\"hidden\" name=\"manualtitle\" value=\"$value[title]\">
                                <li>
                                    <a onclick=\"document.myform$value[id].submit()\" href=\"#\">$value[title]</a>
                                </li>
                            </form>";
        	     }
        	?>
    	</ul>
    </div>
    <form id="search" name="search_form" method="post" action="search.php" onsubmit="return validForm ();">
    	<input type="search" id="search_box" name="search_text" placeholder="Поиск по сайту">
    	<input type="submit" id="search_button" value="">
    </form>
</header>