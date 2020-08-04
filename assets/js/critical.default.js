/**
 * Загрузка меню для главной страницы
 */
setTimeout(function () {
    jQuery("#blockBest50").click(function () {
        var p = Joomla.getOptions('modMyodJshoppingCat') ;
        wgnz11.load.js( wgnz11.Options.Ajax.siteUrl + "modules/mod_myod_jshopping_cat/assets/js/mod_myod_jshopping_cat.js?" + p.___v);
    })
},500);