<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Slickmap
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'SlickMap' => 'system/modules/slickmap/SlickMap.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_slickmap' => 'system/modules/slickmap/templates',
));
