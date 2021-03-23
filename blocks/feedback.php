<div id="feedbackWin" class="modalwin">
	<form onsubmit="checkForm();return false">
        <h2> Обратная связь </h2>        	
        <input id="name" class="inputtext" type="text" placeholder="Имя" onchange="checkName()">
        <input id="email" class="inputtext" type="text" placeholder="Электронная почта" onchange="checkEmail()">
        <textarea id="message" class="inputtext" type="text" placeholder="Текст сообщения" onchange="checkMessage()"></textarea>
        <div id="messageShow">ошибка</div>
        <input id="sendbutton" type="submit" class="inputtext" value="ОТПРАВИТЬ">
    </form>        
</div>
<script src="js/feedbackscript.js"></script>