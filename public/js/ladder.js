var JsLadder = {
    records: new Array(),
    loadRecords: function() {
        $.getJSON(Url.generate('ajax/getPersosList'), null, function(data) {
            JsLadder.records = data;
            JsLadder.display("xp");
        });
    },
    display: function(order_by) {
        $('#ladder').html('');
        var list = ArrayUtils.orderRows(JsLadder.records, order_by);
        $(list).each(function(index, row) {
            JsLadder.displayRow(index + 1, row);
        });
    },
    displayRow: function(pos, row) {
        $tr = $('<tr>');
        if (pos < 4) {
            $tr.addClass('pos' + pos);
            $td = $('<td>').append(Assets.img('trophy/trophy_' + pos + '.png', pos));
            $tr.append($td);
        } else {
            $tr.append('<td style="text-align: center;">' + pos + '</td>');
        }

        $tr.append('<td>' + row["name"] + '</td><td>' + JsLadder.getHeadImg(row['class'], row['sexe']) + '</td><td>' + row["level"] + '</td><td>' + row['xp'] + '</td><td>' + row['kamas'] + '</td>');
        $('#ladder').append($tr);
    },
    getHeadImg: function(classID, sex) {
        var str_class;
        switch (parseInt(classID)) {
            case 1:
                str_class = 'feca';
                break;
            case 2:
                str_class = 'osa';
                break;
            case 3:
                str_class = 'enu';
                break;
            case 4:
                str_class = 'sram';
                break;
            case 5:
                str_class = 'xel';
                break;
            case 6:
                str_class = 'eca';
                break;
            case 7:
                str_class = 'eni';
                break;
            case 8:
                str_class = 'iop';
                break;
            case 9:
                str_class = 'cra';
                break;
            case 10:
                str_class = 'sadi';
                break;
            case 11:
                str_class = 'sacri';
                break;
            case 12:
                str_class = 'pand';
                break;
            default :
                str_class = '';
                break;
        }
        str_class += (sex == "0" ? '_m' : '_f');
        return Assets.img('heads/' + str_class + '.png', str_class);
    }
};
JsLadder.loadRecords();
$('a[data-column]').click(function() {
    JsLadder.display($(this).data('column'));
});


