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
        return '<img src="' + Url.baseUrl() + 'public/images/' + name + '" title="' + title + '" />';
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
        
        if(!asc)
            return final.reverse();
        
        return final;
    },
    internal: {
        partition: function(array, begin, end, pivot, column) {
            var piv = array[pivot][column];
            
            if(!isNaN(piv)){
                piv = parseInt(piv);
            }
            
            array.swap(pivot, end - 1);
            var store = begin;
            var ix;
            for (ix = begin; ix < end - 1; ++ix) {
                var val = array[ix][column];
                
                if(!isNaN(val)){
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
        qsort: function(array, begin, end, column){
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