<?php
/**
 * @version      1.0.0 27/02/2015
 * @author       Odlord
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
error_reporting(1 & ~E_NOTICE);
/*if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
} */


JLoader::registerNamespace( 'GNZ11' , JPATH_LIBRARIES . '/GNZ11' , $reset = false , $prepend = false , $type = 'psr4' );


    require_once(JPATH_SITE . '/components/com_jshopping/lib/factory.php');
    require_once(JPATH_SITE . '/components/com_jshopping/lib/jtableauto.php');
    require_once(JPATH_SITE . '/components/com_jshopping/tables/config.php');
    require_once(JPATH_SITE . '/components/com_jshopping/lib/functions.php');
    require_once(JPATH_SITE . '/components/com_jshopping/lib/multilangfield.php');
    require_once(dirname(__FILE__) . '/helper.php');

    



    $app = JFactory::getApplication();

    $document = JFactory::getDocument();
    $doc = \Joomla\CMS\Factory::getDocument();

    $controller = $app->input->get('controller' , false ) ;
    $view = $app->input->get('view' , $controller );

    




    # Версия модуля
    if( !defined('MOD_MYOD_JSHOPPING_CAT_VERSION') )
    {
        $xml_file = JPATH_ROOT . '/modules/mod_myod_jshopping_cat/mod_myod_jshopping_cat.xml';
        $dom = new DOMDocument("1.0", "utf-8");
        $dom->load($xml_file);
        $version = $dom->getElementsByTagName('version')->item(0)->textContent;
        define('MOD_MYOD_JSHOPPING_CAT_VERSION', $version);
    }









    $category_id = JRequest::getInt('category_id');
    // Get params
    $category = JTable::getInstance('category', 'jshop');




    $Options = [
        '___v' => MOD_MYOD_JSHOPPING_CAT_VERSION,
        'category_id' => $category_id ,
    ];
    $document->addScriptOptions('modMyodJshoppingCat', $Options);



    
    $lang = JFactory::getLanguage();
    if( file_exists(JPATH_SITE . '/components/com_jshopping/lang/' . $lang->getTag() . '.php') )
        require_once(JPATH_SITE . '/components/com_jshopping/lang/' . $lang->getTag() . '.php');
    else
        require_once(JPATH_SITE . '/components/com_jshopping/lang/en-GB.php');
    
    JTable::addIncludePath(JPATH_SITE . '/components/com_jshopping/tables');

    /** @var object $params */
    $field_sort = $params->get('category_sort', 'id');
    $ordering = $params->get('sort_order', 'asc');
    $display_img = $params->get('display_img', '1');
    $count = $params->get('counter', 0);
    $class = $params->get('moduleclass_sfx', '');
    


if( $params->get('cssstyle') == 1 )
{
    $tpl = explode(":", $params->get('layout'));
    //$tpl        = explode(":", $params->def('template'));
    if( $tpl[0] == '_' )
    {
        $jtpl = $app->getTemplate();
    }
    else
    {
        $jtpl = $tpl[0];
    }



    $doc->addScriptOptions('modMyodJshoppingCat', ['tmpl' => $tpl[1], 'selectors' => ['btn' => '#blockBest50',],]);






    // Скрипт инициализации
    $paramsScript = [
        'debug' => $params->get('debug_on' , false ) ,
    ] ;
    switch ($view){
        # Для главной страницы
        case 'featured' :
            # предварительная загрузка стилей
            $document->addCustomTag('<link rel="preload" as="style" href="'.JURI::root().'modules/mod_myod_jshopping_cat/tmpl/'.$tpl[1].'/css/style.css?'.MOD_MYOD_JSHOPPING_CAT_VERSION.'">');

            $pathScript = JPATH_ROOT.'/modules/mod_myod_jshopping_cat/assets/js/critical.featured.js';
            \GNZ11\Document\Document::addIncludeScriptDeclaration( $pathScript , $paramsScript ) ;
            break ;
        case 'product' :
            $pathScript = JPATH_ROOT.'/modules/mod_myod_jshopping_cat/assets/js/critical.default.js';
            \GNZ11\Document\Document::addIncludeScriptDeclaration( $pathScript , $paramsScript ) ;
            if( $app->input->get('format' , false ) != 'json' ) return ; #END IF


        # для всех страниц кроме главной
        default :
            $pathScript = JPATH_ROOT.'/modules/mod_myod_jshopping_cat/assets/js/critical.default.js';
            \GNZ11\Document\Document::addIncludeScriptDeclaration( $pathScript , $paramsScript ) ;
    }
}


    $arResult = ModMyodJshoppingCatHelper::getCatsArray($params, $category_id, $category);



    $jshopConfig = JSFactory::getConfig();

    require JModuleHelper::getLayoutPath('mod_myod_jshopping_cat', $params->get('layout', 'default'));



?>


