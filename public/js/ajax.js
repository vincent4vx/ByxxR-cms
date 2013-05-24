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
       
	this.xhr.open('POST', url, false);
	this.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	this.xhr.send(vars);
	this.loading = true;
	this.loaded = false;
	
	this.loaded = true;
	this.response = this.xhr.responseText;
	this.loading = false;	    
	return this.response;
    };
    
    this.parseJsonPage = function(url, vars){	
	this.loadPage(url, vars);
	if(this.loaded){
	    return JSON.parse(this.response);
        }
        return false;
    };
}


