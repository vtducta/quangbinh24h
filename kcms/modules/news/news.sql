--
-- Table structure for table `news_article`
--

CREATE TABLE IF NOT EXISTS `news_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slugname` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `intro` text NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `last_edited_id` int(11) DEFAULT NULL,
  `last_edited_name` varchar(255) DEFAULT '',
  `status` int(1) NOT NULL,
  `comment_allow` int(1) NOT NULL,
  `view` int(11) NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_article_category`
--

CREATE TABLE IF NOT EXISTS `news_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id_category_id_UNIQUE` (`article_id`,`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE IF NOT EXISTS `news_article_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id_tag_id_UNIQUE` (`article_id`,`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slugname` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slugname_UNIQUE` (`slugname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_page`
--

CREATE TABLE IF NOT EXISTS `news_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slugname` varchar(255) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_slug` varchar(255) DEFAULT NULL,
  `meta_description` varchar(555) DEFAULT NULL,
  `create_time` int(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slugname_UNIQUE` (`slugname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE IF NOT EXISTS `news_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;