function display_form_error(elemId, error)
{
    document.getElementById(elemId).style.border="1px solid red";
    document.getElementById(elemId + "Error").innerHTML='<img src="public/images/devtool/error.png" title="' + error + '" />';
}
	    
function form_valid(elemId)
{
    document.getElementById(elemId).style.border="1px solid #55FF55";
    document.getElementById(elemId + "Error").innerHTML="<img src=\"public/images/devtool/ok.png\" />";
}

function validateForm(url, form)
{
    var vars = '';
    for(var elem in form.elements)
    {
	if(isNaN(elem))
	    break;
	if(form.elements[elem].name != 'submit')
	    vars += form.elements[elem].name + "=" + encodeURIComponent(form.elements[elem].value) + "&";
    }
    
    var ajax = new Ajax();
    var errors = ajax.parseJsonPage(url, vars);
    if(errors == true)
    {
	return true;
    }
    for(var id in errors)
    {
	display_form_error(id, errors[id]);
    }
    return false;
}

var formManager = {
    displayError: function(elemId, error){
        document.getElementById(elemId).style.border="1px solid red";
        document.getElementById(elemId + "Error").innerHTML=assets.img('devtool/error.png', error);
    },
    rowValid: function(elemId){
        document.getElementById(elemId).style.border="1px solid #55FF55";
        document.getElementById(elemId + "Error").innerHTML=assets.img("devtool/ok.png", "Champ valide !");
    },
    validateForm: function(name, form){
        var uri = url.generate('ajax/validateform/' + name);
        var vars = '';
        for(var elem in form.elements){
            if(isNaN(elem))
                break;
            if(form.elements[elem].name != 'submit')
                vars += form.elements[elem].name + "=" + encodeURIComponent(form.elements[elem].value) + "&";
        }

        var ajax = new Ajax();
        var errors = ajax.parseJsonPage(uri, vars);

        if(errors == true){
            return true;
        }

        if(errors == false){
            alert('Erreur indéfinie !');
            return false;
        }

        for(var id in errors){
            if(id != 'alert_msg')
                formManager.displayError(id, errors[id]);
        }

        if(errors['alert_msg']){
            alert(errors['alert_msg']);
        }else{
            alert('Les champs sont invalides !');
        }
        
        return false;
    }
};


