-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `slickmap_utility_pages` blob NULL,
  `slickmap_root` blob NULL,
  `slickmap_stop_level` int(10) unsigned NOT NULL default '0',
  `slickmap_articles` char(1) NOT NULL default '',
  `slickmap_show_hidden` char(1) NOT NULL default '',
  `slickmap_ignore_sitemap` char(1) NOT NULL default '',
  `slickmap_columns` char(4) NOT NULL default 'auto'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
