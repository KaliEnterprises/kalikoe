CREATE TABLE IF NOT EXISTS `elgg_user_point_details` (
  `point_details_id` int(11) NOT NULL auto_increment,
  `content_id` int(11) NOT NULL,
  `content_owner_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY  (`point_details_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
