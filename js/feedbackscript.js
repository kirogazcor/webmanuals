var feedback = document.getElementById('feedback');
feedback.addEventListener("click",showFeedbackWin);
// Функция отображения окна обратной связи
function showFeedbackWin() {
var darkLayer = document.createElement('div'); // слой затемнения
darkLayer.id = 'shadow'; // id чтобы подхватить стиль
document.body.appendChild(darkLayer); // включаем затемнение
var modalWin = $('feedbackWin'); // находим наше "окно"
modalWin.style.display = 'block'; // "включаем" его
darkLayer.onclick = function () { // при клике на слой затемнения все исчезнет
darkLayer.parentNode.removeChild(darkLayer); // удаляем затемнение
$('name').value = "";
$('email').value = "";
$('message').value = "";
$('messageShow').style.display = 'none';
modalWin.style.display = 'none'; // делаем окно невидимым
return false;
};
}
// Обработчик проверки имени
function checkName(){
var messageShow = $('messageShow');
messageShow.style.display = 'none';
var name = $('name').value;
var fail = validName(name);
if (fail != ""){
messageShow.style.display = 'block';
messageShow.innerHTML = fail;
}
}
// Функция проверки имени
function validName(name){
if(name == "") return "Имя не введено";
else if (!/^[\wа-яА-ЯёЁ\s]{3,127}$/.test(name))
return "Длина имени от 3 до 127 букв или цифр";
else return "";
}
//Обработчик проверки E-mail
function checkEmail(){
var messageShow = $('messageShow');
messageShow.style.display = 'none';
var email = $('email').value;
var fail = validEmail(email);
if (fail != ""){
messageShow.style.display = 'block';
messageShow.innerHTML = fail;
}
}
// Функции проверки имени
function validEmail(email){
if(email == "") return "E-mail не введен";
else if (!/^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i.test(email))
return "Некорректный E-mail";
else return "";
}
// Обработчик проверки текста сообщения
function checkMessage(){
var messageShow = $('messageShow');
messageShow.style.display = 'none';
var message = $('message').value;
if (message == ""){
messageShow.style.display = 'block';
messageShow.innerHTML = "Введите сообщение";
}
}
// Обработчик проверки полей формы
function checkForm(){
var name = $('name').value;
var email = $('email').value;
var message = $('message').value;
var messageShow = $('messageShow');
messageShow.style.display = 'none';
var fail = validName(name) + "<br>" + validEmail(email);
if (fail == "<br>"){
if(message == ""){
messageShow.style.display = 'block';
messageShow.innerHTML = "Введите сообщение";
}
else {
messageShow.style.display = 'block';
var args = "name=" + name + "&email=" + email + "&message=" + message;
SendRequest("POST", "send.php", args, sendMailResult, messageShow);
}
}
else{
if(message == ""){
messageShow.style.display = 'block';
messageShow.innerHTML = fail + "<br>Введите сообщение";
}
else {
messageShow.style.display = 'block';
messageShow.innerHTML = fail;
}
}
return false;
}