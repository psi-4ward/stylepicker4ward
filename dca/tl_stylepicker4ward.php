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


$GLOBALS['TL_DCA']['tl_stylepicker4ward'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'					  => 'tl_theme',
		'enableVersioning'            => true,
		'oncopy_callback'			  => array(array('Stylepicker4ward\DcaHelper','copy')),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('title'),
			'headerFields'            => array('name', 'author', 'tstamp'),
			'flag'                    => 1,
			'child_record_callback'   => array('Stylepicker4ward\DcaHelper', 'generateItem'),
			'panelLayout'             => 'sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title','cssclass'),
			'format'                  => '%s <span style="color:#999">[%s]</span>',
		),
		'global_operations' => array
		(
			'import' => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['stylepicker4ward_import'],
				'href'  => 'key=stylepicker4ward_import',
				'class' => 'header_new'
			),
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
				'href'				  =>  'act=paste&amp;mode=copy',
				'icon'				  => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
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
		'default'                     => '{info_legend},title,cssclass,description,image;{layouts_legend},layouts;{CEs_legend},_CEs,_CE_Row;{Article_legend},_Article,_Article_Row,_ArticleTeaser;{Pages_legend},_Pages'
	),
	
	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_layout.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['title'],
			'inputType'               => 'text',
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['description'],
			'inputType'				  => 'textarea',
			'search'				  => true,
			'eval'					  => array('style'=>'height:50px;', 'tl_class' => 'clr'),
			'sql'					  => "text NULL"
		),
		'image' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['image'],
			'inputType'				  => 'fileTree',
			'eval'					  => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,png,jpg'),
			'sql'                     => "blob NULL"
		),
		'cssclass' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['cssclass'],
			'inputType'               => 'text',
			'sorting'                 => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		),
		
		'layouts' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['layouts'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('Stylepicker4ward\DcaHelper','getPagelayouts'),
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadPagelayouts')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','savePagelayouts')),
			'eval'					  => array('mandatory'=>true, 'multiple'=>true, 'doNotSaveEmpty'=>false, 'doNotCopy'=>true, 'tl_class'=>'w50" style="height:auto;'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		),
		
		// Content Elements
		'_CEs' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CEs'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('Stylepicker4ward\DcaHelper','getContentElements'),
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadCEs')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','saveCEs')),
			'reference'               => &$GLOBALS['TL_LANG']['CTE'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		'_CE_Row' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CE_Row'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('Stylepicker4ward\DcaHelper','getSections'),
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadCE_Rows')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','doNothing')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_article'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		
		// Articles 
		'_Article' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_Article'],
			'inputType'               => 'checkbox',
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadArticles')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','saveArticles')),
			'eval'					  => array('doNotSaveEmpty'=>true, 'tl_class'=>'w50')
		),
		'_ArticleTeaser' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_ArticleTeaser'],
			'inputType'				  => 'checkbox',
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadArticleTeasers')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','saveArticleTeasers')),
			'eval'					  => array('doNotSaveEmpty'=>true, 'tl_class'=>'w50')
		),
		'_Article_Row' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_CE_Row'],
			'inputType'               => 'checkbox',
			'options_callback'		  => array('Stylepicker4ward\DcaHelper','getSections'),
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadArticle_Rows')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','doNothing')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_article'],
			'eval'					  => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'tl_class'=>'w50" style="height:auto;')
		),
		
		// Pages 
		'_Pages' => array
		(
			'label'				      => &$GLOBALS['TL_LANG']['tl_stylepicker4ward']['_Pages'],
			'inputType'               => 'checkbox',
			'load_callback'			  => array(array('Stylepicker4ward\DcaHelper','loadPages')),
			'save_callback'			  => array(array('Stylepicker4ward\DcaHelper','savePages')),
			'eval'					  => array('doNotSaveEmpty'=>true, 'tl_class'=>'w50')
		),		
	)
);
