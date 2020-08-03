window.modMyodJshoppingCat = function () {
    var $ = jQuery ;
    var self = this ;
    this.__v = '003'
    this.__type = 'modules' ;
    this.__name = 'modMyodJshoppingCat' ;
    this.__group = null ;
    this.__param = Joomla.getOptions( this.__name , {} );
    this.Host = null ;



    this.Init = function () {
        this.__v = this.__param.___v ;
        this.Host = wgnz11.Options.Ajax.siteUrl ;
        /*console.log( this.__param )*/
        Promise.all([
            self.load.css(this.Host+'modules/mod_myod_jshopping_cat/tmpl/'+this.__param.tmpl+'/css/style.css?'+this.__v) ,
            self.load.js(this.Host+'modules/mod_myod_jshopping_cat/tmpl/'+this.__param.tmpl+'/js/accordion.js?'+this.__v) ,

        ]).then(function ( a)
        {
            self.fromTemplate('#__template_divId_div_top_menu');
            initMenu2();
            self.onClick();
            $(self.__param.selectors.btn).off().on('click' , self.onClick )
        })


    };
    this.onClick = function () {
        if ( jQuery("#divId").css('display') == 'none' ) {
            jQuery("#divId").show();
        } else {
            jQuery("#divId").hide();
        }
    }
    this.Init();
}
window.modMyodJshoppingCat.prototype = new GNZ11() ;
new window.modMyodJshoppingCat();

