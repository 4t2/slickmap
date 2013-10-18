<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['slickmap_primary_legend'] = 'SlickMap Hauptseiten';
$GLOBALS['TL_LANG']['tl_content']['slickmap_utility_legend'] = 'SlickMap Hilfsseiten';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['slickmap_utility_pages'] = array('Hilfsseiten', 'Hilfsseiten wie bspw. Impressum oder Kontakt.');
$GLOBALS['TL_LANG']['tl_content']['slickmap_root'] = array('Startseite', 'Startseite der Sitemap.');
$GLOBALS['TL_LANG']['tl_content']['slickmap_stop_level'] = array('Stoplevel', 'Bis zu welcher Tiefe sollen Seiten aufgelistet werden. Eingabe 0 um alle Seiten anzeigen zu lassen.');
$GLOBALS['TL_LANG']['tl_content']['slickmap_articles'] = array('Artikel extra anzeigen', 'Artikel der Hauptseiten extra auflisten, wenn es mehr als einen Artikel zu der Seite gibt.');
$GLOBALS['TL_LANG']['tl_content']['slickmap_show_hidden'] = array('Versteckte Seiten anzeigen', 'Alle Seiten anzeigen, auch wenn sie im Menü versteckt sind.');
$GLOBALS['TL_LANG']['tl_content']['slickmap_ignore_sitemap'] = array('Sitemap-Einstellungen ignorieren', 'Auch Seiten anzeigen, wenn sie in der Contao Sitemap ausgeschlossen sind.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_content']['slickmap_columns']['title'] = array('Spalten', 'Anzahl der Spalten');
$GLOBALS['TL_LANG']['tl_content']['slickmap_columns']['reference'] = array(
	'auto'	=> 'automatisch',
	'1'		=> '1 Spalte',
	'2'		=> '2 Spalten',
	'3'		=> '3 Spalten',
	'4'		=> '4 Spalten',
	'5'		=> '5 Spalten',
	'6'		=> '6 Spalten',
	'7'		=> '7 Spalten',
	'8'		=> '8 Spalten',
	'9'		=> '9 Spalten',
	'10'	=> '10 Spalten'
);

?>