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

            if ( $('#__template_divId_div_top_menu_div' )[0] ){
                self.fromTemplate('#__template_divId_div_top_menu_div');
                initMenu2();
                self.onClick();
                $(self.__param.selectors.btn).off().on('click' , self.onClick );
            }else{
                var $divId = $("#divId") ;
                var request = {
                    'option' : 'com_ajax',
                    'module' : 'myod_jshopping_cat',
                    'method' : 'getMenu',
                    'category_id' : self.__param.category_id ,
                    'format' :  'json'

                    /*'cmd'    : action,
                    'data'   : value,
                    'format' : '{$format}'*/
                }
                wgnz11.getModul("Ajax").then(function (Ajax) {
                    // Не обрабатывать сообщения

                    console.log( Ajax )
                    Ajax.Loader = true ;
                    console.log( Ajax )
                    // Отправить запрос
                    Ajax.send(request).then(function (r) {
                        $divId.children().append(r.data.html);

                        initMenu2();
                        self.onClick();
                        $(self.__param.selectors.btn).off().on('click' , self.onClick );
                    },function(err) {
                        console.error(err)
                    })
                });
            }



        })


    };
    this.onClick = function () {
        var $divId = $("#divId")
        if ( $divId.css('display') === 'none' ) {
            $divId.show();
        } else {
            $divId.hide();
        }
    }
    this.Init();
}
window.modMyodJshoppingCat.prototype = new GNZ11() ;
new window.modMyodJshoppingCat();

