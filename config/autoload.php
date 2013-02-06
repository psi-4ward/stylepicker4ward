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


// Register the classes
ClassLoader::addClasses(array
(
	'Stylepicker4ward' 	=> 'system/modules/stylepicker4ward/Stylepicker4ward.php',
));

// Register the templates
TemplateLoader::addFiles(array
(
	'be_stylepicker4ward' 					=> 'system/modules/stylepicker4ward/templates',
));
