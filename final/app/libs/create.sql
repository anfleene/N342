CREATE TABLE posts (
  id int NOT NULL auto_increment,
  title varchar(50),
  body text, 
  created datetime default NULL,
  modified datetime default NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE comments (
  id int NOT NULL auto_increment,
  body text, 
	post_id int NOT NULL,
  created datetime default NULL,
  modified datetime default NULL,
 	FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
  PRIMARY KEY  (id)
);

CREATE TABLE tags (
  id int NOT NULL auto_increment,
	name varchar(50),
  created datetime default NULL,
  modified datetime default NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE posts_tags (
  id int NOT NULL auto_increment,
	post_id int NOT NULL,
	tag_id int NOT NULL,
	created datetime default NULL,
  modified datetime default NULL,
 	FOREIGN KEY (post_id) REFERENCES posts(id),
 	FOREIGN KEY (tag_id) REFERENCES tags(id),
  PRIMARY KEY  (id)
);
-- CREATE TABLE users (
--   id int NOT NULL auto_increment,
--   name varchar(255) default NULL,
--   age int(11) default NULL,
--   is_active tinyint(1) default NULL,
--   created datetime default NULL,
--   modified datetime default NULL,
--   PRIMARY KEY  (id)
-- )