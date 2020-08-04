/**
 * Загрузка меню для главной страницы
 */
document.addEventListener("GNZ11Loaded", function () {
    var p = Joomla.getOptions('modMyodJshoppingCat') ;
    wgnz11.load.js( wgnz11.Options.Ajax.siteUrl + "modules/mod_myod_jshopping_cat/assets/js/mod_myod_jshopping_cat.js?" + p.___v);
});