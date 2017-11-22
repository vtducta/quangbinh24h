--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
 `session_id` varchar(64) NOT NULL DEFAULT '',
 `session_user_agent` varchar(32) NOT NULL DEFAULT '',
 `session_data` text NOT NULL,
 `session_expire` int(10) NOT NULL DEFAULT '0',
 `session_user_action` varchar(255) NOT NULL,
 `session_user_action_id` int(10) NOT NULL DEFAULT '0',
 `session_user_action_info` varchar(255) NOT NULL DEFAULT '',
 `session_user_location` text NOT NULL,
 PRIMARY KEY (`session_id`),
 KEY `session_expire` (`session_expire`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8