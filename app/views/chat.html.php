<?php
if(!$this->title){
    $this->title = 'Chat Box';
    $this->titleImg = 'accueil';
}
?>
<div class="forumContainer" id="chatBox">
    <div class="title">Chat Box</div>
    <div id="chatContent"></div>
    <?php if($this->session->isLog()):?>
    <form action="#">
        <input type="text" id="content" placeholder="Votre message..."/>
        <input type="submit" id="send" value="Envoyer !"/>
    </form>
    <?php endif?>
</div>
<script type="text/javascript">
    function refreshChat(){
        $.getJSON(Url.generate('ajax/getChatMsg'), null, function(data){
            var contents = '';
            for(var row in data){
                var d = new Date(data[row]['time'] * 1000);
                if(d.getHours() < 10)
                    var d_str = '0' + d.getHours();
                else
                    var d_str = d.getHours();
                d_str += ':';
                if(d.getMinutes() < 10)
                    d_str += '0' + d.getMinutes();
                else
                    d_str += d.getMinutes();

                contents = '<div class="row">' + d_str + ' : ' + data[row]['author'] + ' > ' + htmlentities(data[row]['content']) + '</div>' + contents;
            }
            $('#chatContent').html(contents).scrollTop(1000);
        });
    }
    window.setInterval(refreshChat, 3000);

$('#send').click(function(){
    if($.trim($('#content').val()) == ''){
        alert('Veuillez renseigner le message à envoyer !');
        return;
    }
    
    $('#send').val('En cours...').attr('disabled', 'disabled');
    var d = new Date();
    var data = {
        content: $('#content').val(),
        time: d.getTime() / 1000
    };
    $.post(Url.generate('ajax/postChatMsg'), data, function(res){
        $('#send').val('Envoyer !').removeAttr('disabled');
        $('#content').val('');
        if(res != '')
            alert(res);
        refreshChat();
    });
});
</script>
