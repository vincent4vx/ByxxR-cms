var formManager = {
    displayError: function(elemId, error){
        $('#' + elemId).css('border', '1px solid red');
        $('#' + elemId + 'Error').html(Assets.img('devtool/error.png', error));
    },
    rowValid: function(elemId){
        $('#' + elemId).css('border', '1px solid #55FF55');
        $('#' + elemId + 'Error').html(Assets.img("devtool/ok.png", "Champ valide !"));
    },
    validateForm: function(name, form){
        var uri = Url.generate('ajax/validateform/' + name);
        var vars = '';
        
        $('input').each(function(){
            var row = $(this);
            if(row.attr('type') == 'submit'){
                row.attr('disabled', true);
            }else if(row.attr('type') != 'undefined')
                vars += row.attr('name') + '=' + encodeURIComponent(row.val()) + '&';
        });

        $.post(uri, vars, function(data){
            var errors = JSON.parse(data);
            
            if(errors == true){
                window.location.href = $(form).attr('action');
                return;
            }

            if(errors == false){
                alert('Erreur indéfinie !');
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

            $('[type="submit"]').removeAttr('disabled');
        });
        return false;
    }
};


