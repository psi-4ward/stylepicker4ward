<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2011
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    stylepicker4ward
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
		$objErg = $this->Database->prepare('SELECT DISTINCT(fld) FROM tl_stylepicker4ward_target WHERE tbl=?')->execute($table);
		if($objErg->numRows <= 0) return;

		while($objErg->next())
		{
			$GLOBALS['TL_DCA'][$table]['fields'][$objErg->fld]['eval']['tl_class'] .= ' wizard';
			$GLOBALS['TL_DCA'][$table]['fields'][$objErg->fld]['wizard']['stylepicker'] = array('Stylepicker4ward','getStylepicker');
		}
		
		// little hack to adjust the wizard for the article-section
		if($table == 'tl_article')
			$GLOBALS['TL_DCA'][$table]['fields']['inColumn']['eval']['submitOnChange'] = true;
	}
	
	public function getStylepicker($dc)
	{
		if(version_compare(VERSION,'2.9','<='))
		{
			// load the lightbox for contao < 2.10
			$GLOBALS['TL_JAVASCRIPT']['mediabox'] = 'plugins/mediabox/js/mediabox.js';
			$GLOBALS['TL_CSS']['mediabox'] = 'plugins/mediabox/css/mediabox_white.css';
			$GLOBALS['TL_JAVASCRIPT']['mediabox_scanpage'] = 'system/modules/_stylepicker4ward/html/mediabox_scanpage.js';
		}
		
		$GLOBALS['TL_CSS']['stylepicker4ward'] = 'system/modules/_stylepicker4ward/html/style.css';
		return ' <a href="system/modules/_stylepicker4ward/popup.php?'
		            . 'tbl='.$dc->table
		            . '&fld='.$dc->field
		            . '&inputName=ctrl_'.$dc->inputName
		            . '&id='.$dc->id
		            . '" rel="lightbox[files 765 60%]" data-lightbox="files 765 60%">' . $this->generateImage('system/modules/_stylepicker4ward/html/icon.png', $GLOBALS['TL_LANG']['MSC']['stylepicker4ward'], 'style="vertical-align:top;"').'</a>';
		
	}
	
}

?>