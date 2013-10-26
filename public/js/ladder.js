var CharLadder = RecordsHandler;

CharLadder.prototype.clear = function() {
    $('#ladder').html('');
};

CharLadder.prototype.displayRow = function(pos, row) {
    $tr = $('<tr>');
    if (pos < 4) {
        $tr.addClass('pos' + pos);
        $td = $('<td>').append(Assets.img('trophy/trophy_' + pos + '.png', pos));
        $tr.append($td);
    } else {
        $tr.append('<td style="text-align: center;">' + pos + '</td>');
    }

    $tr.append('<td>' + row["name"] + '</td><td>' + Assets.classImg(row['class'], row['sexe']) + '</td><td>' + row["level"] + '</td><td>' + row['xp'] + '</td><td>' + row['kamas'] + '</td>');
    $('#ladder').append($tr);
};

CharLadder.prototype.construct = function(){
    this.__recordsLoader(
            Url.generate('ajax/getPersosList.json'),
            function(instance){
                instance.display('xp', false, 0, 20);
            },
            600
    );
        
    var _i = this;
    
    $(document).on('click', 'a[data-column]', function(){
        $a = $(this);
        _i.display($a.data('column'), $a.data('asc'), 0, 20);
    });
};


var ladder = new CharLadder();

var pagi = new Pagination();

pagi.nb_pages = Math.ceil(ladder.size() / 20);
pagi.registerCallback(function(page){
   ladder.display('xp', false, (page - 1) * 20, 20);
});

pagi.display();




