<?php

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);

class ModMyodJshoppingCatHelper{
	public static function getTreeCats($category, $params, $active_id, $parent_id = 0, $deep = 1){

        $jshopConfig = JSFactory::getConfig();
		
		$rows  = $category->getSubCategories($parent_id, $params->get('category_sort', 'id'), $params->get('sort_order', 'asc'), 1);
         
		$skip_categories = $params->get('skip_categories' , false , 'RAW' ) ;
        $skip_categoriesArr = explode(  ',' , $skip_categories ) ;
        if( count( $skip_categoriesArr ) )
        {
            foreach ( $rows as $i => $row )
            {
                if( in_array( $row->category_id , $skip_categoriesArr ) )
                {
                      unset( $rows[$i] ) ;
                }#END IF

                
            }#END FOREACH
        }#END IF
		/*echo'<pre>';print_r( $skip_categoriesArr );echo'</pre>'.__FILE__.' '.__LINE__;
		echo'<pre>';print_r( $rows );echo'</pre>'.__FILE__.' '.__LINE__;
		die(__FILE__ .' '. __LINE__ );*/




		$odcatarr = array();
		if(count($rows))
		foreach($rows as $row) {
			if (in_array($row->category_id, array(857,810))) continue;
			$child = $category->getSubCategories($row->category_id, $params->get('category_sort', 'id'), $params->get('sort_order', 'asc'), 1);
			// Show counter
			if($params->get('counter', 0)) {
				$category->category_id = $row->category_id;
				$counter = $category->getCountProducts('');
			}

			$odcatarr[] = array(
				'NAME' => $row->name, 
				'LINK' => $row->category_link, 
				'SELECTED' => in_array($row->category_id, $active_id), 
				'ACTIVE' => $row->category_publish, 
				'COUNT' => $counter, 
				'IS_PARENT' => count($child) ? true : false, 
				'DEPTH' => $deep, 
				'IMG' => $row->category_image,
				);

				// Show child
			if(count($child)) {
				$deep++;
				$odcatarr = array_merge($odcatarr, ModMyodJshoppingCatHelper::getTreeCats($category, $params, $active_id, $row->category_id, $deep));
				$deep--;
			}
		}
		
		return $odcatarr;
    }
    
    public static function getCatsArray($params, $active_id, $category)
	{
	    $category->load($active_id);
    	$categories_id = $category->getTreeParentCategories();
	    return ModMyodJshoppingCatHelper::getTreeCats($category, $params, $categories_id);
    }

    public static function getMenuAjax (){
        $data = [] ;
        $module = ModuleHelper::getModule('myod_jshopping_cat');
        $data['html'] = JModuleHelper::renderModule($module);
        echo new JResponseJson($data);
        die( );


    }

}










