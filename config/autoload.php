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

\Contao\ClassLoader::addNamespace('Psi');

// Register the classes
ClassLoader::addClasses(array
(
		'Psi\Stylepicker4ward\DcaHelper' => 'system/modules/_stylepicker4ward/classes/DcaHelper.php',
		'Psi\Stylepicker4ward\Importer'  => 'system/modules/_stylepicker4ward/classes/Importer.php',
));

// Register the templates
TemplateLoader::addFiles(array
(
		'be_stylepicker4ward'          => 'system/modules/_stylepicker4ward/templates',
		'be_stylepicker4ward_importer' => 'system/modules/_stylepicker4ward/templates',
));
