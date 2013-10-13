(function() {
    var now, date;
    date = new Date();
    now = date.getTime();

    if ((localStorage.getItem('update_time') + 24 * 3600 * 1000) < now) {
        preload();
        localStorage.setItem('update_time', now + 24 * 3600 * 1000);
    }

    $('img[data-url]').each(function() {
        var imgUrl = $(this).data('url');
        var data = Cache.get(imgUrl);
        if (!data)
            $(this).attr('src', imgUrl);
        else
            $(this).attr('src', data);
        $(this).removeAttr('data-url');
    });
})();

function preload() {
    var preload = [
        'title/img_404.png',
        'title/img_accueil.png',
        'title/img_admin.png',
        'title/img_equipe.png',
        'title/img_forum.png',
        'title/img_inscription.png',
        'title/img_ladder.png',
        'title/img_ladder_guilde.png',
        'title/img_ladder_vote.png',
        'title/img_presentation.png',
        'title/img_profil.png',
        'title/img_reglement.png',
        'title/img_vote.png',
        'title/img_boutique.png',
        'imgInscription.png',
        'trophy/trophy_1.png',
        'trophy/trophy_2.png',
        'trophy/trophy_3.png',
        'heads/SmallHead_0.png',
        'heads/cra_f.png',
        'heads/cra_m.png',
        'heads/ca_f.png',
        'heads/ca_m.png',
        'heads/ni_f.png',
        'heads/ni_m.png',
        'heads/nu_f.png',
        'heads/nu_m.png',
        'heads/feca_f.png',
        'heads/feca_m.png',
        'heads/iop_f.png',
        'heads/iop_m.png',
        'heads/osa_f.png',
        'heads/osa_m.png',
        'heads/pand_f.png',
        'heads/pand_m.png',
        'heads/acri_f.png',
        'heads/acri_m.png',
        'heads/adi_f.png',
        'heads/adi_m.png',
        'heads/ram_f.png',
        'heads/ram_m.png',
        'heads/xel_f.png',
        'heads/xel_m.png',
        'config.png',
        'download.png'
    ];

    $(preload).each(function(index, value) {
        var imgUrl = Url.baseUrl() + 'public/images/' + value;

        var xhr = new XMLHttpRequest(),
                blob,
                fileReader = new FileReader();

        xhr.open("GET", imgUrl, true);
        // Set the responseType to arraybuffer. "blob" is an option too, rendering BlobBuilder unnecessary, but the support for "blob" is not widespread enough yet
        xhr.responseType = "arraybuffer";

        xhr.addEventListener("load", function() {
            if (xhr.status === 200) {
                // Create a blob from the response
                blob = new Blob([xhr.response], {type: "image/png"});

                // onload needed since Google Chrome doesn't support addEventListener for FileReader
                fileReader.onload = function(evt) {
                    // Read out file contents as a Data URL
                    var result = evt.target.result;
                    // Store Data URL in localStorage
                    Cache.store(imgUrl, result, 24 * 3600 * 7);
                };
                // Load blob as Data URL
                fileReader.readAsDataURL(blob);
            }
        }, false);
        // Send XHR
        xhr.send();
    });
}

function saveBase64Img(imgUrl) {

}