var Url = {
    baseUrl: function() {
        return base_url;
    },
    generate: function(route) {
        return Url.baseUrl() + 'index.php/' + route;
    }
};

var Assets = {
    img: function(name, title) {
        if (!title) {
            title = name;
        }
        var src = Url.baseUrl() + 'public/images/' + name;
        var data;
        
        if((data = Cache.get(src)) !== false){
            src = data;
        }
        
        return '<img src="' + src + '" title="' + title + '" />';
    },
    classImg: function(classID, sex) {
        var classes = ['feca', 'osa', 'enu', 'sram', 'xel', 'eca', 'eni', 'iop', 'cra', 'sadi', 'sacri', 'pand'];
        var name;

        if (classID < 1 || classID > classes.length) {
            name = 'SmallHead_0';
        } else {
            name = classes[classID - 1] + (sex == 0 ? '_m' : '_f');
        }

        return this.img('heads/' + name + '.png', name);
    }
};

function htmlentities(string) {
    return string.replace('&', '&amp;').replace('<', '&lt;').replace('>', '&gt;');
}


var ArrayUtils = {
    /**
     * Réordonne un tableau d'enregistrement DB
     * @param {Array} rows les enregistrements
     * @param {string} column nom de la colonne d'ordonnement
     * @param {boolean} asc mettre true pour organiser de façon ascendante
     * @returns {Array} les enregistrements triées
     */
    orderRows: function(rows, column, asc) {
        var final = rows;
        ArrayUtils.internal.qsort(final, 0, rows.length, column);

        if (!asc)
            return final.reverse();

        return final;
    },
    internal: {
        partition: function(array, begin, end, pivot, column) {
            var piv = array[pivot][column];

            if (!isNaN(piv)) {
                piv = parseInt(piv);
            }

            array.swap(pivot, end - 1);
            var store = begin;
            var ix;
            for (ix = begin; ix < end - 1; ++ix) {
                var val = array[ix][column];

                if (!isNaN(val)) {
                    val = parseInt(val);
                }

                if (val <= piv) {
                    array.swap(store, ix);
                    ++store;
                }
            }
            array.swap(end - 1, store);

            return store;
        },
        qsort: function(array, begin, end, column) {
            if (end - 1 > begin) {
                var pivot = begin + Math.floor(Math.random() * (end - begin));

                pivot = ArrayUtils.internal.partition(array, begin, end, pivot, column);

                ArrayUtils.internal.qsort(array, begin, pivot, column);
                ArrayUtils.internal.qsort(array, pivot + 1, end, column);
            }
        }
    }
};

Array.prototype.swap = function(a, b) {
    var tmp = this[a];
    this[a] = this[b];
    this[b] = tmp;
};


/**
 * Système de cache
 * Utilise le localstorage
 * @type Object
 */
var Cache = {
    /**
     * Limitaion de la taille à 500Kio
     * @type Number
     */
    MAXSIZE: 1024 * 500,
    /**
     * Enregistre une variable dans le cache
     * @param {String} key la clé du cache
     * @param {mixed} value La valeur à enregistrer
     * @param {Numeric} time Durée (de vie) en seconde
     * @returns {Boolean} true en succès, false sinon (+ message dans console)
     */
    store: function(key, value, time) {
        if (!time) {
            time = 60;
        }
        var d = new Date();
        var data = {
            del: d.getTime() + time * 1000,
            value: value
        };

        var str = JSON.stringify(data);

        if (str.length * 2 > this.MAXSIZE) {
            console.log("Impossible d'enregistrer " + key + " dans la cache : taille maximal dépassé (" + str.length * 2 + "o)");
            return false;
        }

        try {
            localStorage.setItem('cache_' + key, str);
        } catch (e) {
            console.log("Impossible d'enregistrer " + key + " dans la cache : " + e);
            return false;
        }

        return true;
    },
    get: function(key) {
        var data = JSON.parse(localStorage.getItem('cache_' + key));

        if (!data) {
            return false;
        }

        var curtime = (new Date()).getTime();

        if (data.del <= curtime) {
            Cache.remove(key);
            return false;
        }

        return data.value;
    },
    /**
     * Supprime du cache
     * @param {string} key
     * @returns {undefined}
     */
    remove: function(key) {
        localStorage.removeItem('cache_' + key);
    }
};

function RecordsHandler() {
    /**
     * Tout les enregistrements à lister / trier
     * @type Array
     * @private
     */
    var records = new Array();
    /**
     * Enresgitrements triés
     * @type Array
     * @private
     */
    var ordered_records = new Array();
    /**
     * Chargement des enregistrements
     * @param {string} JSON_uri l'url où on peut load les records (en JSON)
     * @param {callback} recordsLoaded Callback appelé après que les records soient chargées
     * @param {int|null} cache_time durée de la mise en cache (null ou désactiver)
     * @returns {null}
     * @private
     */
    this.__recordsLoader = function(JSON_uri, recordsLoaded, cache_time) {
        if (cache_time) {
            var data = Cache.get(JSON_uri);
            var instance = this;

            if (data !== false) {
                this.records = data;
                recordsLoaded(instance);
                return;
            }

            $.getJSON(JSON_uri, null, function(data) {
                if (cache_time) {
                    Cache.store(JSON_uri, data, cache_time);
                }
                instance.records = data;
                recordsLoaded(instance);
            });
        }
    };
    /**
     * Réordonne et affiche les enregistrements
     * @param {string} order_by Nom de la colonne utilisé comme clé de trie
     * @param {int} start le début de l'affichage.
     * @param {int} length nombre de lignes à afficher. Si ommi, affichage jusqu'à la fin
     * @returns {undefined}
     */
    this.display = function(order_by, asc, start, length) {
        //$('#ladder').html('');
        this.clear();
        
        var list;
        if(order_by){
            list = ArrayUtils.orderRows(this.records, order_by, asc);
            ordered_records = list;
        }else{
            list = ordered_records;
        }
        var end;

        if (!length) {
            end = list.length;
        } else {
            end = start + length;

            if (end > list.length) {
                end = list.length;
            }
        }

        for (var i = start; i < end; ++i) {
            this.displayRow(i + 1, list[i]);
        }

    };
    
    this.size = function(){
        return this.records.length;;
    }

    this.construct();
};


function Pagination(){
    this.cur_page = 1;
    this.nb_pages = 1;
    this.nb_links = 5;
    this.selector = '#pagination';
    var callback = function(page){
        alert('Page = ' + page);
    };
    
    this.registerCallback = function(func){
        callback = func;
    };
    
    this.display = function(){
        if(this.nb_pages < 2){
            return;
        }
        
        $elem = $(this.selector);
        $elem.html('');
        
        if(this.cur_page > 2){
            $elem.append('<a href="#" data-page="1">&lt;&lt;</a>');
        }
        
        if(this.cur_page > 1){
            $elem.append('<a href="#" data-page="' + (this.cur_page - 1) + '">&lt;</a>');
        }
        
        var page = this.cur_page - Math.floor(this.nb_links / 2) - 1;
        
        if(page < 0){
            page = 0;
        }
        
        var last = page + Math.ceil(this.nb_links / 2) + 2;
        
        if(last > this.nb_pages){
            last = this.nb_pages;
        }
        
        while(++page <= last){
            if(page === this.cur_page)
                $elem.append('<span class="current">' + page + '</span>');
            else
                $elem.append('<a href="#" data-page="' + page + '">' + page + '</a>');
        }
        
        if(this.cur_page < this.nb_pages){
            $elem.append('<a href="#" data-page="' + (this.cur_page + 1) + '">&gt;</a>');
        }
        
        if(this.cur_page < this.nb_pages - 1){
            $elem.append('<a href="#" data-page="' + this.nb_pages + '">&gt;&gt;</a>');
        }
        
        prepareClick();
    };
    
    var instance = this;
    
    var prepareClick = function(){
        $(instance.selector).children('a').click(function(){
            var page = $(this).data('page');
            instance.cur_page = page;
            callback(page);
            instance.display();
        });
    };
    
    this.reset = function(){
        this.cur_page = 1;
        this.display();
    };
}