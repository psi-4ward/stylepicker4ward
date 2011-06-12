-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_stylepicker4ward`
-- 

CREATE TABLE `tl_stylepicker4ward` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `description` text NULL,
  `image` varchar(255) NOT NULL default '',
  `cssclass` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 
-- Table `tl_stylepicker4ward_target`
-- 

CREATE TABLE `tl_stylepicker4ward_target` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `tbl` varchar(128) NOT NULL default '',
  `fld` varchar(128) NOT NULL default '',
  `cond` varchar(255) NOT NULL default '',
  `sec` varchar(128) NOT NULL default '',  
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
