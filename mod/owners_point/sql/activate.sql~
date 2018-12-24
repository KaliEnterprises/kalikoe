
CREATE TABLE get_user_point (
    
    user_id int(12) NOT NULL,
    user_name varchar(255),
    user_email varchar(255),
    
    PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS `elgg_user_point_details` (
  `point_details_id` int(11) NOT NULL auto_increment,
  `content_id` int(11) NOT NULL,
  `content_owner_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(5) NOT NULL,
  `get_point` int(11) NOT NULL,
  `content_type` varchar(255) NOT NULL,
  PRIMARY KEY  (`point_details_id`),
  FOREIGN KEY (content_owner_id) REFERENCES get_user_point(user_id)
);

CREATE TABLE IF NOT EXISTS `elgg_user_point` (
  `point_id` int(12) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `total_point` int(11) NOT NULL,
 
  PRIMARY KEY  (`point_id`),
  FOREIGN KEY (user_id) REFERENCES get_user_point(user_id)
);

