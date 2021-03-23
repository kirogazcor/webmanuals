<?php 
    // Подключение к базе данных
    function connectDB() {
        $connDB=new mysqli("localhost","...","...","manuals");
        $connDB->query("SET NAMES 'UTF-8'");
        return $connDB;
    }
    
    // Отключение от базы данных
    function closeDB($connDB) {
        $connDB->close();        
    }  
    
    // Получение списка заголовков
    function getTitles($table){
        $connDB = connectDB();
        $result = $connDB->query("SELECT id,title FROM $table ORDER BY id");
        closeDB($connDB);
        $array = array();
        while (($row = $result->fetch_assoc())) {
            $array[] = $row;
        }
        return $array;
    }
    
    // Получение записи по идентификатору
    function getById($id,$table){
        $connDB = connectDB();
        $result = $connDB->query("SELECT * FROM $table WHERE id = $id");
        closeDB($connDB);
        return $result->fetch_assoc();
    }
    
    // Форматирование текста справочника
    function formatTextManual($text, $search_text) {
        preg_match_all('|<mycode>(.+)</mycode>|isU',$text,$code_arr);
        for ($i = 0; $i < count($code_arr[1]); $i++) {
            $code_arr[1][$i]=str_replace("&","&amp",$code_arr[1][$i]);
            $code_arr[1][$i]=str_replace("<","&lt",$code_arr[1][$i]);
            $code_arr[1][$i]=str_replace(">","&gt",$code_arr[1][$i]);
            $code_arr[1][$i]=str_replace("\"","&quot",$code_arr[1][$i]);
            $code_arr[1][$i]=str_replace("\'","&#039",$code_arr[1][$i]);
        }
        $text=preg_replace('|(<mycode>).+(</mycode>)|isU', "$1".""."$2",$text);
        $text_array=explode("\n",$text);
        $text="";
        foreach ($text_array as $row) {
            $text.="<p>".$row."</p>";
        }
        for ($j = 0; $j < count($code_arr[1]); $j++) {
            $search='|<mycode></mycode>|';
            $replace="<pre><code>".$code_arr[1][$j]."</code></pre>";
            $text=preg_replace($search, $replace, $text, 1);
        }
        if($search_text != "")
            $text=preg_replace('|'.$search_text.'|', "<de>".$search_text."</de>", $text);        
        return $text;
    }
    
    // функция поиска по сайту
    function search($query, $tabTitles) {
        $connDB = connectDB();
        $array = array();
        foreach ($tabTitles as $tabTitle){
            $table = getByID($tabTitle['id'], 'my_manuals');
            $q = "SELECT * FROM ".$table['name']." WHERE text_charter LIKE '%$query%'";
            $result = $connDB->query($q);
            $subarray = array();
            while (($row = $result->fetch_assoc())) {
                $subarray[] = $row;
            }
            if(count($subarray))$array[$tabTitle['id']] = $subarray;                        
        }
        return $array;
    }
    
    // Вычисление количества совпадений
    function getCoincide($search_text, $charter_text){
        $text_array = explode($search_text, $charter_text);
        $count = count($text_array)-1;
        return $count;
    }    
?>