<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Lingo4you 2011
 * @author     Mario Müller <http://www.lingo4u.de/>
 * @package    SlickMap
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['slickmap'] = '{type_legend},type,headline;{slickmap_primary_legend},slickmap_root,slickmap_stop_level,slickmap_columns,slickmap_show_hidden,slickmap_ignore_sitemap,slickmap_articles;{slickmap_utility_legend},slickmap_utility_pages;{expert_legend:hide},cssID,space';


$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_utility_pages'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_utility_pages'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array(
		'mandatory'	=> false,
		'fieldType'	=> 'checkbox'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_root'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_root'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array(
		'mandatory'	=> false,
		'fieldType'	=> 'radio'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_stop_level'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_stop_level'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'tl_class'	=> 'w50',
		'rgxp'		=> 'digit',
		'maxlength'	=> 2
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_columns'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['slickmap_columns']['title'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'				  => array('auto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_content']['slickmap_columns']['reference'],
	'eval'                    => array(
		'includeBlankOption'	=> false,
		'maxlength'				=> 4,
		'tl_class'				=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_articles'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_articles'],
	'exclude'		=> true,
	'inputType'		=> 'checkbox',
	'eval'			=> array(
		'tl_class'	=> 'w50 clr m12'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_show_hidden'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_show_hidden'],
	'exclude'		=> true,
	'inputType'		=> 'checkbox',
	'eval'			=> array(
		'tl_class'	=> 'w50 m12'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['slickmap_ignore_sitemap'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_content']['slickmap_ignore_sitemap'],
	'exclude'		=> true,
	'inputType'		=> 'checkbox',
	'eval'			=> array(
		'tl_class'	=> 'w50 m12'
	)
);

?>