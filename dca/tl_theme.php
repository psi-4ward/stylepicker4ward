<?php

/**
 * Contao Extension to pick predefined CSS-Classes in the backend
 *
 * @copyright  4ward.media 2013
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @see        http://www.4wardmedia.de
 * @package    stylepicker4ward
 * @licence    LGPL
 * @filesource
 */


// Add the theme-operation icon
array_insert($GLOBALS['TL_DCA']['tl_theme']['list']['operations'],6,
	array('stylepicker4ward' =>
		array
		(
			'label'               => &$GLOBALS['TL_LANG']['tl_theme']['stylepicker4ward'],
			'href'                => 'table=tl_stylepicker4ward',
			'icon'                => 'system/modules/stylepicker4ward/assets/icon.png'
		)
	)
);
