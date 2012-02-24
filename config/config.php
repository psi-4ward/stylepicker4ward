<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2011
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    stylepicker4ward
 * @filesource
 */

if(TL_MODE == 'BE')
{
	$GLOBALS['BE_MOD']['design']['themes']['tables'][] = 'tl_stylepicker4ward';
	$GLOBALS['BE_MOD']['design']['themes']['tables'][] = 'tl_stylepicker4ward_target';

	$GLOBALS['TL_HOOKS']['loadDataContainer']['stylepicker4ward'] = array('Stylepicker4ward','injectStylepicker');

	$GLOBALS['TL_EASY_THEMES_MODULES']['stylepicker4ward'] = array
	(
			'href_fragment' => 'table=tl_stylepicker4ward',
			'icon'          => 'system/modules/_stylepicker4ward/html/icon.png'
	);
}
?>