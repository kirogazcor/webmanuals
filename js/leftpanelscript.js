// Скольжения окна оглавления
window.addEventListener("scroll",function(){
	var element = $('contents');
	var scroll_element = $('scroll_contents');
	if(element.getBoundingClientRect().bottom >  0) {
		scroll_element.style.opacity = '0';
	}
	else scroll_element.style.opacity = '1';	
});