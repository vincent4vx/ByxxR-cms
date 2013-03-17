var url = {
    baseUrl: function(){
        return base_url;
    },
    generate: function(route){
        return url.baseUrl()+route;
    }
};

var assets = {
    img: function(name){
        return '<img src="' + url.baseUrl() + 'public/images/' + name + '" />';
    }
};


