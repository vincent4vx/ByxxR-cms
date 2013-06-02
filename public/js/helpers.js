var Url = {
    baseUrl: function(){
        return base_url;
    },
    generate: function(route){
        return Url.baseUrl()+'index.php/'+route;
    }
};

var Assets = {
    img: function(name, title){
        return '<img src="' + Url.baseUrl() + 'public/images/' + name + '" title="' + title + '" />';
    }
};

function htmlentities(string){
    return string.replace('&', '&amp;').replace('<', '&lt;').replace('>', '&gt;');
}




