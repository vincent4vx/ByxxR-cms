var PER_PAGE = 20;
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
                instance.display('xp', false, 0, PER_PAGE);
            },
            600
    );
    
    $(document).on('click', 'a[data-column]', onHeaderClick);
};


var ladder = new CharLadder();

var pagi = new Pagination();

pagi.nb_pages = Math.ceil(ladder.size() / PER_PAGE);
pagi.registerCallback(function(page){
   ladder.display(false, false, (page - 1) * PER_PAGE, PER_PAGE);
});

pagi.display();

function onHeaderClick(){
    $a = $(this);
    ladder.display($a.data('column'), $a.data('asc'), 0, PER_PAGE);
    pagi.reset();
}




