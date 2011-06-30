<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2011
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    stylepicker4ward
 * @filesource
 */

array_insert($GLOBALS['TL_DCA']['tl_theme']['list']['operations'],6,
	array('stylepicker4ward' =>
		array
		(
			'label'               => &$GLOBALS['TL_LANG']['tl_theme']['stylepicker4ward'],
			'href'                => 'table=tl_stylepicker4ward',
			'icon'                => 'system/modules/_stylepicker4ward/html/icon.png'
		)
	)
);


?>