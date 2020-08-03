<?php
/**
 * @version      1.0.0 27/02/2015
 * @author       Odlord
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
error_reporting(error_reporting() & ~E_NOTICE);
/*if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
} */

    $app = JFactory::getApplication();
    $document = JFactory::getDocument();

    $view = $app->input->get('view');
    # Версия модуля
    if( !defined('MOD_MYOD_JSHOPPING_CAT_VERSION') )
    {
        $xml_file = JPATH_ROOT . '/modules/mod_myod_jshopping_cat/mod_myod_jshopping_cat.xml';
        $dom = new DOMDocument("1.0", "utf-8");
        $dom->load($xml_file);
        $version = $dom->getElementsByTagName('version')->item(0)->textContent;
        define('MOD_MYOD_JSHOPPING_CAT_VERSION', $version);
    }




require_once(dirname(__FILE__) . '/helper.php');









$Options = ['___v' => MOD_MYOD_JSHOPPING_CAT_VERSION,];
$document->addScriptOptions('modMyodJshoppingCat', $Options);

require_once(JPATH_SITE . '/components/com_jshopping/lib/factory.php');
require_once(JPATH_SITE . '/components/com_jshopping/lib/jtableauto.php');
require_once(JPATH_SITE . '/components/com_jshopping/tables/config.php');
require_once(JPATH_SITE . '/components/com_jshopping/lib/functions.php');
require_once(JPATH_SITE . '/components/com_jshopping/lib/multilangfield.php');

$lang = JFactory::getLanguage();
if( file_exists(JPATH_SITE . '/components/com_jshopping/lang/' . $lang->getTag() . '.php') )
    require_once(JPATH_SITE . '/components/com_jshopping/lang/' . $lang->getTag() . '.php');
else
    require_once(JPATH_SITE . '/components/com_jshopping/lang/en-GB.php');

JTable::addIncludePath(JPATH_SITE . '/components/com_jshopping/tables');

$field_sort = $params->get('category_sort', 'id');
$ordering = $params->get('sort_order', 'asc');
$display_img = $params->get('display_img', '1');

$count = $params->get('counter', 0);
$class = $params->get('moduleclass_sfx', '');

// Get params     
$category_id = JRequest::getInt('category_id');
$category = JTable::getInstance('category', 'jshop');

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


    $doc = \Joomla\CMS\Factory::getDocument();
    $doc->addScriptOptions('modMyodJshoppingCat', ['tmpl' => $tpl[1], 'selectors' => ['btn' => '#blockBest50',],]);

    # Для главной страницы предварительная загрузка стилей
    if( $view == 'featured' )
    {
        $document->addCustomTag('<link rel="preload" as="style" href="'.JURI::root().'modules/mod_myod_jshopping_cat/tmpl/'.$tpl[1].'/css/style.css?'.MOD_MYOD_JSHOPPING_CAT_VERSION.'">');
        $document->addScriptDeclaration('
            document.addEventListener("GNZ11Loaded", function () {
                wgnz11.load.js("'.JURI::root().'/modules/mod_myod_jshopping_cat/assets/js/mod_myod_jshopping_cat.js?'.MOD_MYOD_JSHOPPING_CAT_VERSION.'");
            });
        ');
    }else{
        $document->addScriptDeclaration('
            setTimeout(function () {
                jQuery("#blockBest50").click(function () {
                    wgnz11.load.js("'.JURI::root().'/modules/mod_myod_jshopping_cat/assets/js/mod_myod_jshopping_cat.js?'.MOD_MYOD_JSHOPPING_CAT_VERSION.'");
                })
            },500);
        ');
    }#END IF
    

}

$arResult = modMYODJShoppingCategoryHelper::getCatsArray($params, $category_id, $category);

$jshopConfig = JSFactory::getConfig();

require JModuleHelper::getLayoutPath('mod_myod_jshopping_cat', $params->get('layout', 'default'));

?>