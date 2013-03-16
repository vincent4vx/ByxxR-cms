function getXHR() {
  var xhr = null;
  
  
  if(window.XMLHttpRequest || window.ActiveXObject) {
    if(window.ActiveXObject) {
      try {
        xhr = new ActiveXObject('Msxml2.XMLHTTP');
      } catch(e) {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      }
    } else {
      xhr = new XMLHttpRequest();
    }
    
  } else {
    return null;
  }
  
  return xhr;
}

function loadPage(url, vars)
{
    if(!vars)
	vars = '';
    var xhr = getXHR();
    
    xhr.onreadystatechange = function(){
	if(xhr.readyState == 4){
	    alert(xhr.responseText);
	    return xhr.responseText;
	}
    };
       
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(vars);
    alert('ok');
    
}

function parseJsonPage(url, vars)
{
    if(!vars)
	vars = '';
    var errors = JSON.parse(loadPage(url, vars));
    alert(errors);
    return errors;
}

function Ajax()
{
    this.xhr = null;
    this.loaded = false;
    this.loading = false;
    this.response = '';
    
    this.getXhr = function(){
	  var xhr = null;  
  
	    if(window.XMLHttpRequest || window.ActiveXObject) {
		if(window.ActiveXObject) {
		    try {
			xhr = new ActiveXObject('Msxml2.XMLHTTP');
		    } catch(e) {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		    }
		} else {
		    xhr = new XMLHttpRequest();
		}
    
	    } else {
		return null;
	}  
	return xhr;
    };
    
    this.loadPage = function(url, vars){
	if(!vars)
	    vars = '';
	
	if(this.xhr == null)
	    this.xhr = this.getXhr();
	
	if(this.xhr.readyState != 0){
	    this.xhr.abort();
	}
    
	/*this.xhr.onreadystatechange = function(){
	    alert(this.xhr.readyState);
	    if(this.xhr.readyState == 4){
		alert(this.xhr.responseText);
		this.loaded = true;
		this.response = this.xhr.responseText;
		this.loading = false;
	    }
	};*/
       
	this.xhr.open('POST', url, false);
	this.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	this.xhr.send(vars + "ajax");
	this.loading = true;
	this.loaded = false;
	
	if(this.xhr.status == 200)
	{
	    this.loaded = true;
	    this.response = this.xhr.responseText;
	    this.loading = false;	    
	    return this.response;
	}
	return false;
    };
    
    this.parseJsonPage = function(url, vars){
	/*if(!this.loading)
	{
	    alert('loading');
	    if(!vars)
		vars = '';
	    this.loadPage(url, vars);
	}*/
    
	//while(this.loaded){}
	
	this.loadPage(url, vars);
	if(this.loaded)
	    return JSON.parse(this.response);
	return false;
    };
}

