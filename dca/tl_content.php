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

// Add Callback to show the css-classes in the contentelement-listing
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_callback'] = array('tl_content_stylepicker', 'addClassNames');


class tl_content_stylepicker extends tl_content
{

	/**
	 * Show the css-classes in the contentelement listing
	 *
	 * @param $arrRow
	 * @return string
	 */
	public function addClassNames($arrRow)
	{
		$ret = '';
		$cssID = deserialize($arrRow['cssID']);
		$ret .= $this->addCteType($arrRow);
		if($cssID[1])
		{
			$ret .= '<div style="position: absolute; top: 30px; color: #999; right: 10px">'.$GLOBALS['TL_LANG']['tl_content']['_cssclasses'].''.$cssID[1].'</div>';
		}
		return $ret;
	}
}