var lib=function(s){
	var sel = document.querySelector(s);
	return sel;
}
var $ = function(el){
	if(el==null)
		rerurn false;
	return lib(el);
}