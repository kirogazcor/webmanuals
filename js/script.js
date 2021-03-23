// Переименование метода document.getElementById
function $(id) {
return document.getElementById(id);
}
//Кроссбаузерная AJAX-функция
function ajaxRequest(){
try{
var request = new XMLHttpRequest();
}
catch(e1){
try{
request = new ActiveXObject("Msxml.XMLHTTP");
}
catch (e2){
try{
request = new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e3){
request = false;
}
}
}
return request;
}
// Обработчик результатов отправки сообщения
function sendMailResult(request, container){
var text = "";
if(request.readyState == 4){
if(request.status == 200){
if(request.responseText != null)
text = request.responseText;
else text = "Ошибка AJAX: Данные не получены"
}
else text = "Ошибка AJAX: " + request.statusText;
}
container.innerHTML = text;
}
// Функция запроса к файлу на сервере
function SendRequest(r_method, r_path, r_args, r_handler, r_container){
var request = new ajaxRequest();
if(!request)return;
request.onreadystatechange = function() {
r_handler(this, r_container);
}
//Проверяем, если требуется сделать GET-запрос
if (r_method.toLowerCase() == "get" && r_args.length > 0)
r_path += "?" + r_args;
request.open(r_method, r_path, true);
if (r_method.toLowerCase() == "post"){
//Если это POST-запрос
request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
request.send(r_args);
}
else{
//Если это GET-запрос
request.send(null);
}
}
// Функция проверки поля поиска
function validForm ( )
{
var valid = true;
var search_box = document.search_form.search_text;
if ( search_box.value == "" )
{
search_box.placeholder = "Введите запрос";
valid = false;
}
return valid;
}