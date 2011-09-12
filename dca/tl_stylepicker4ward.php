<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2011
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    stylepicker4ward
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_stylepicker4ward'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'					  => 'tl_theme',
		'enableVersioning'            => true,
		'oncopy_callback'			  => array(array('tl_stylepicker4ward','copy'))
	
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title','cssclass'),
			'format'                  => '%s <span style="color:#999">[%s]</span>',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)		
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'				  => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['copy'],
				'href'				  => 'act=copy',
				'icon'				  => 'copy.gif'
			),			
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
		
	// Palettes
	'palettes' => array
	(
		'default'                     => '{info_legend},title,cssclass,description,image;{layouts_legend},layouts;{CEs_legend},_CEs,_CE_Row;{Article_legend},_Article,_Article_Row;{Pages_legend},_Pages'
	),
	
	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['title'],
			'inputType'               => 'text',
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50')
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['description'],
			'inputType'				  => 'textarea',
			'search'				  => true,
			'eval'					  => array('style'=>'height:50px;')
		),
		'image' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['image'],
			'inputType'				  => 'fileTree',
			'eval'					  => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,png,jpg')
		),
		'cssclass' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['cssclass'],
			'inputType'               => 'text',
			'sorting'                 => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50')
		),
		
		'layouts' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['layouts'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_stylepicker4ward','getPagelayouts'),
			'load_callback'			  => array(array('tl_stylepicker4ward','loadPagelayouts')),
			'save_callback'			  => array(array('tl_stylepicker4ward','savePagelayouts')),
			'eval'					  => array('mandatory'=>true, 'multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')		
		),
		
		// Content Elements
		'_CEs' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CEs'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_stylepicker4ward','getContentElements'),
			'load_callback'			  => array(array('tl_stylepicker4ward','loadCEs')),
			'save_callback'			  => array(array('tl_stylepicker4ward','saveCEs')),
			'reference'               => &$GLOBALS['TL_LANG']['CTE'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		'_CE_Row' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CE_Row'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_stylepicker4ward','getSections'),
			'load_callback'			  => array(array('tl_stylepicker4ward','loadCE_Rows')),
			'save_callback'			  => array(array('tl_stylepicker4ward','doNothing')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_article'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		
		// Articles 
		'_Article' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_Article'],
			'inputType'               => 'checkbox',
			'load_callback'			  => array(array('tl_stylepicker4ward','loadArticles')),
			'save_callback'			  => array(array('tl_stylepicker4ward','saveArticles')),
			'eval'					  => array('doNotSaveEmpty'=>true, 'tl_class'=>'w50')
		),
		'_Article_Row' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CE_Row'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('tl_stylepicker4ward','getSections'),
			'load_callback'			  => array(array('tl_stylepicker4ward','loadArticle_Rows')),
			'save_callback'			  => array(array('tl_stylepicker4ward','doNothing')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_article'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		
		// Pages 
		'_Pages' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_Pages'],
			'inputType'               => 'checkbox',
			'load_callback'			  => array(array('tl_stylepicker4ward','loadPages')),
			'save_callback'			  => array(array('tl_stylepicker4ward','savePages')),
			'eval'					  => array('doNotSaveEmpty'=>true, 'tl_class'=>'w50')
		),		
	)
);


class tl_stylepicker4ward extends Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}

	/* ===========================*/
	/*********** Pages ************/
	/* ===========================*/	
	public function savePages($val,$dc)
	{
		// delete all records for this table/pid
		$this->truncateTargets($dc->id,'tl_page');
		
		if(strlen($val))
		{
			$this->saveTarget($dc->id,'tl_page','cssClass');				
		}
		return '';
	}
	public function loadPages($val,$dc)
	{
		$arrReturn = array();
		$objTargets = $this->Database->prepare('SELECT count(pid) AS anz FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($dc->id,'tl_page');
		return ($objTargets->anz > 0) ? '1' : ''; 
	}
	
	/* ===========================*/
	/********** Articles **********/
	/* ===========================*/
	public function saveArticles($val,$dc)
	{
		// delete all records for this table/pid
		$this->truncateTargets($dc->id,'tl_article');
		
		if(strlen($val))
		{
			// get sections
			$secs = $this->Input->post('_Article_Row');
			if(!is_array($secs) || !count($secs))
				return '';
			
			// save foreach section
			foreach($secs as $sec)
			{
				$this->saveTarget($dc->id,'tl_article','cssID',$sec);				
			}			
		}
		return '';
	}
	public function loadArticles($val,$dc)
	{
		$arrReturn = array();
		$objTargets = $this->Database->prepare('SELECT count(pid) AS anz FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($dc->id,'tl_article');
		return ($objTargets->anz > 0) ? '1' : ''; 
	}
	public function loadArticle_Rows($val,$dc)
	{
		$arrReturn = array();
		$objTargets = $this->Database->prepare('SELECT DISTINCT(sec) FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($dc->id,'tl_article');
		while($objTargets->next())
		{
			$arrReturn[] = $objTargets->sec;
		}
		return serialize($arrReturn);
	}
	
	
	
	/* ===========================*/
	/****** Content elements ******/
	/* ===========================*/
	public function saveCEs($val,$dc)
	{
		// delete all records for this table/pid
		$this->truncateTargets($dc->id,'tl_content');
		
		$vals = unserialize($val);
		if(is_array($vals))
		{
			// get sections
			$secs = $this->Input->post('_CE_Row');
			if(!is_array($secs) || !count($secs))
				return '';
			
			// save CEs foreach section
			foreach($secs as $sec)
			{
				foreach($vals as $val)
				{	
					$this->saveTarget($dc->id,'tl_content','cssID',$sec,$val);				
				}
			}	
		}
		return '';
	}
	public function loadCEs($val,$dc)
	{
		$arrReturn = array();
		$objTargets = $this->Database->prepare('SELECT DISTINCT(cond) FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($dc->id,'tl_content');
		while($objTargets->next())
		{
			$arrReturn[] = $objTargets->cond;
		}
		return serialize($arrReturn);
	}
	public function loadCE_Rows($val,$dc)
	{
		$arrReturn = array();
		$objTargets = $this->Database->prepare('SELECT DISTINCT(sec) FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($dc->id,'tl_content');
		while($objTargets->next())
		{
			$arrReturn[] = $objTargets->sec;
		}
		return serialize($arrReturn);
	}
	/**
	* lädt vorhandene Inhaltselemente aus $GLOBALS['TL_CTE']
	* @return array
	*/
	public function getContentElements()
	{
		$arrCEs = array();
		foreach ($GLOBALS['TL_CTE'] as $key => $arr)
		{
			foreach ($arr as $elementName => $val)
			{
				array_push($arrCEs, $elementName);
			}
		}

		return $arrCEs;    
	}
	
	
	
	public function loadPagelayouts($val)
	{
		$val = explode(',',$val);
		return serialize($val);
	}	
	public function savePagelayouts($val)
	{
		$val = unserialize($val);
		return implode(',',$val);
	}
	
	/**
	 * Helperfunction to save a target
	 * @param int $pid
	 * @param str $tbl
	 * @param str $field
	 * @param str $section
	 * @param str $condition
	 */
	protected function saveTarget($pid,$tbl,$field,$section='',$condition='')
	{
		// delete old CEs
		$this->Database->prepare('INSERT INTO tl_stylepicker4ward_target SET pid=?,tbl=?,fld=?,sec=?,cond=?,tstamp=?')
					   ->execute($pid,$tbl,$field,$section,$condition,time());
		
	}

	/**
	 * Helperfunction to trunce old targets
	 * @param int $pid
	 * @param str $tbl
	 */
	protected function truncateTargets($pid,$tbl)
	{
		$this->Database->prepare('DELETE FROM tl_stylepicker4ward_target WHERE pid=? AND tbl=?')->execute($pid,$tbl);
	}
	
	
	/**
	 * get all sections
	 * @return arraytl_stylepicker4ward_target
	 */
	public function getSections()
	{
		$this->loadLanguageFile('tl_article');
		$ret = array('header','left','right','main','footer');
		
		$custom = explode(',',$GLOBALS['TL_CONFIG']['customSections']);
		if(strlen($GLOBALS['TL_CONFIG']['customSections']) && is_array($custom)) $ret = array_merge($ret,$custom);
				
		return $ret;
	}

	/**
	 * get all pagelayouts for the current theme
	 * @param DataContainer $dc
	 * @return array
	 */
	public function getPagelayouts($dc)
	{
		$objLayouts = $this->Database->prepare('SELECT id,name FROM tl_layout WHERE pid=?')->execute($dc->activeRecord->pid);
		$arrLayouts = array();
		while($objLayouts->next())	$arrLayouts[$objLayouts->id] = $objLayouts->name;
		return $arrLayouts;
	}
	
	/**
	 * void function for some callbacks
	 * @return string ''
	 */
	public function doNothing()
	{
		return '';
	}
	
	/**
	 * copy a definition
	 * @param int $insertID
	 * @param DataContainer $dc
	 */
	public function copy($insertID, $dc)
	{
		// also copy targets
		$this->Database->prepare('INSERT INTO tl_stylepicker4ward_target (pid,tstamp,tbl,fld,cond,sec)
									SELECT ?, UNIX_TIMESTAMP(), tbl,fld,cond,sec 
									FROM tl_stylepicker4ward_target 
									WHERE pid=?')->execute($insertID,$dc->id);
	}

	
	

}


?>