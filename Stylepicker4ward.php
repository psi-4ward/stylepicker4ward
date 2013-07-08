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


class Stylepicker4ward extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}


	public function injectStylepicker($table)
	{
		// dont inject in some system-modules
		if(in_array(\Input::get('do'),array('repository_manager', 'repository_catalog', 'maintenance', 'settings', 'log', 'autoload'))) return;


		$objErg = $this->Database->prepare('SELECT DISTINCT(fld) FROM tl_stylepicker4ward_target WHERE tbl=?')->execute($table);
		if($objErg->numRows <= 0) return;

		while($objErg->next())
		{
			$GLOBALS['TL_DCA'][$table]['fields'][$objErg->fld]['eval']['tl_class'] .= ' wizard';
			$GLOBALS['TL_DCA'][$table]['fields'][$objErg->fld]['wizard']['stylepicker'] = array('\Stylepicker4ward','getStylepicker');
		}
		
		// little hack to adjust the wizard for the article-section
		if($table == 'tl_article')
			$GLOBALS['TL_DCA'][$table]['fields']['inColumn']['eval']['submitOnChange'] = true;
	}


	public function getStylepicker($dc)
	{
		$GLOBALS['TL_CSS']['stylepicker4ward'] = 'system/modules/stylepicker4ward/assets/style.css';
		return ' <a href="javascript:Backend.openModalIframe({url:\'system/modules/stylepicker4ward/public/popup.php?'
		            . 'tbl='.$dc->table
		            . '&fld='.$dc->field
		            . '&inputName=ctrl_'.$dc->inputName
		            . '&id='.$dc->id
		            . '\',width:775,title:\'Stylepicker\'});">' . $this->generateImage('system/modules/stylepicker4ward/assets/icon.png', $GLOBALS['TL_LANG']['MSC']['stylepicker4ward'], 'style="vertical-align:top;"').'</a>';
		
	}
	
}
