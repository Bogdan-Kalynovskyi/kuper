<?php
	if(!defined('IN_INSTALL')) 
		die("File Access Denied!");
//date means birth date
//time means latest activity		
//TODO AUTO PREFIX




$table = array();





//////////////////////////////////////////////////////////////
$table['users']=<<<EOF
   id 	 	  INT NOT NULL AUTO_INCREMENT,

  `level`	  TINYINT NOT NULL default 1,

  `login` 	  VARCHAR(64) NOT NULL default '',
  `pass` 	  VARCHAR(64) NOT NULL default '',
  `algo`	  VARCHAR(64)  NOT NULL default 'md2',
  `salt`	  VARCHAR(64)  NOT NULL default 'mzsfzxvd3',
  
  `additional_security_feature` VARCHAR(255),
  `restore`	  VARCHAR(255),

  `name`  	  VARCHAR(255) NOT NULL default '',
  `desc`  	  TEXT NOT NULL default '',
  `pic`  	  TEXT NOT NULL default '',
  `email` 	  VARCHAR(255) NOT NULL default '',
  
  `date` 	  INT UNSIGNED NOT NULL default 0,  

  UNIQUE  (`login`),
  UNIQUE  (`name`),
  UNIQUE  (`email`),
  PRIMARY KEY  (id)
EOF;
//все . тепер сконцентруватися на передач1 даих 1 алгоритм1



////ssl
//передавать пасворд хеш
//////////////////////////////////////////////////////////////
$table['login']=<<<EOF
   id 	 	  BIGINT NOT NULL AUTO_INCREMENT,
	
  `user` 	  INT NOT NULL,
  `sid` 	  VARCHAR(185)  NOT NULL default '',

  `hashing`   INT UNSIGNED NOT NULL default 0,
  `sid_time`  INT UNSIGNED NOT NULL default 0,
  `mac` 	  VARCHAR(185)  NOT NULL default '',
  `chain` 	  VARCHAR(185)  NOT NULL default '',

  `ip` 	 	  INT UNSIGNED NOT NULL default 0,
  `time` 	  INT UNSIGNED NOT NULL default 0,
  `user_agent`VARCHAR(185) NOT NULL default '',

--  INDEX(`sid`),
  INDEX(`ip`),
  PRIMARY KEY  (id)
EOF;
//no index sid


/////////////////////////////////////////////////////////////////////
$table['log']=<<<EOF
  `ip` 		INT UNSIGNED NOT NULL,
  `time`	INT UNSIGNED NOT NULL default 0,
  `num` 	TINYINT NOT NULL default 0,

  PRIMARY KEY  (ip)
EOF;
/////////////////////////////////////////////////////////////////////
$table['log1']=<<<EOF
  `login` 	VARCHAR(8) NOT NULL,
  `time`	INT UNSIGNED NOT NULL default 0,
  `num` 	TINYINT NOT NULL default 0,

  PRIMARY KEY  (login)
EOF;
$table['form']=<<<EOF
  `id` 		BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `hash` 	CHAR(32) NOT NULL default '',
  `user` 	INT NOT NULL,
  
  INDEX (user),
  PRIMARY KEY  (id)
EOF;



/////////////////////////////////////////////////////////////////////
$table['vars']=<<<EOF
  `name` 	VARCHAR(255) NOT NULL default '',
  `val` 	TEXT NOT NULL default '',

  PRIMARY KEY  (name)
EOF;

		
//duplications, html_cache
$table['cache']=<<<EOF
  id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,

  blog 		SMALLINT UNSIGNED NOT NULL default 0,
  cat 		SMALLINT UNSIGNED NOT NULL default 0,
  page 		SMALLINT UNSIGNED NOT NULL default 0,
  pp 		SMALLINT UNSIGNED NOT NULL default 0,
  
  alias 	VARCHAR(95) NOT NULL DEFAULT '',
  
  UNIQUE (alias),
  PRIMARY KEY (id)
EOF;
















//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$table['guestbook']=<<<EOF
  id 		INT UNSIGNED NOT NULL AUTO_INCREMENT,

  name	 	VARCHAR(255) NOT NULL default '',
  icon 		VARCHAR(255) NOT NULL default '',
  email 	VARCHAR(55) NOT NULL default '',
  site	 	VARCHAR(255) NOT NULL default '',
  public	BOOL NOT NULL default 0,

  text  	TEXT  NOT NULL default '',

  date  	INT UNSIGNED NOT NULL default 0,


  INDEX (date),
  PRIMARY KEY  (id)
EOF;



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$table['photo']=<<<EOF
  id 		INT UNSIGNED NOT NULL AUTO_INCREMENT,  
  post 		INT default NULL,
-- parent

  title 	VARCHAR(255) NOT NULL default '',
  summary  	TEXT  NOT NULL default '',

 -- thumb 	TEXT NOT NULL default '',
  icon 		TEXT NOT NULL default '',
--  fullsize 	TEXT NOT NULL default '',

  fon 		TEXT NOT NULL default '',
--  fx 		SHORTINT NOT NULL DEFAULT 0,
--  fy 		SHORTINT NOT NULL DEFAULT 0,
 
  por  		INT NOT NULL  default 0,
  

  INDEX (por),
  INDEX (post),
  PRIMARY KEY  (id, post)
EOF;
//fullsize

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
$table['menu']=<<<EOF
  id 		INT UNSIGNED NOT NULL AUTO_INCREMENT,

  title 	VARCHAR(255) NOT NULL default '',
  summary  	TEXT  NOT NULL default '',

  icon 		TEXT NOT NULL default '', 
  fon 		TEXT NOT NULL default '', 
  por  		INT NOT NULL default 0,


  INDEX (por),
  PRIMARY KEY  (id)
EOF;
для реоевырки в майбутньому*/


$table['posts']=<<<EOF
  id 		INT UNSIGNED NOT NULL AUTO_INCREMENT,
  blog 		SMALLINT UNSIGNED default NULL,
  
	ok BOOL NOT NULL default FALSE,

  title 	VARCHAR(255) NOT NULL default '',
  summary  	TEXT  NOT NULL default '',
  data  	TEXT  NOT NULL default '',
  icon 		TEXT NOT NULL default '', 
  fon 		TEXT NOT NULL default '', 
  date 		INT UNSIGNED NOT NULL default 0,

  gallery	BOOL NOT NULL default FALSE,

  draft 	BOOL NOT NULL default FALSE,
  switch 	BOOL NOT NULL default FALSE,
 
  por  		INT NOT NULL default 0,
  	
	
  INDEX (por),
  INDEX (blog),
  PRIMARY KEY  (id)
EOF;
//fulltext














//№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
	if (isset($_POST['ow']) && $_POST['ow'])
	{
		echo "Dropping existing tables...  ";
		foreach($table as $key=>$body){
			@mysql_query("DROP TABLE IF EXISTS `{$my_prefix}{$key}`") or footer(mysql_error());
		}
		echo "Done <br />";
	}


//№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
	foreach($table as $key=>$body){
		echo "Creating table '{$my_prefix}{$key}' ...  ";

		@mysql_query("CREATE TABLE IF NOT EXISTS `{$my_prefix}{$key}` (
			$body
		)ENGINE=MyISAM DEFAULT CHARSET=$dbchrst;") or  footer(mysql_error()); 

		echo "Done <br />";
	}


//№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№




  if(isset($_POST['ow']) && $_POST['ow']){// АНАЛОГИЧНО , ТАБЛИЦЯМИ
///////////////////////////////////////////////////////////////////////////////////////////////

echo "Inserting data into '{$my_prefix}vars'...  ";
//тут можна зекономити, якщо перем1стити все це в конф1г пхп

	@mysql_query("INSERT INTO `{$my_prefix}vars` (name, val) 
	VALUES  
	
		('lang','ru'),
--		('bodya',''),
--		('more',''),

		('site_title', 'Художник Давид Куперфильд'),
		('site_desc', ''),
		('site_keywords', ''),
--		('site_welcome', ''),

		('date_str','j F Y, G:i'),
		('gmt_diff','3'),

		('email','lvdavid27@list.ru'),
		('phone','8-916-6252199'),
		('fb','8-916-6252199'),
		('vk','8-916-6252199'),
		('lj','8-916-6252199'),
		('contacts','8-916-6252199'),
			
		('per_page','10'),
		('wrap','18'),
		
		('def_fon','images/back7.gif'),
		('def_userpic',''),
		('zastavka','images/KuperFild.jpg'),
			
		('blogs', '".implode("\n", array('Галерея','Выставки','Фотографии','Отзывы','Контакты') )."'),
		('blog_ids', '".implode("\n", array(1,2,3,4,5) )."'),
		('blog_fons', '".implode("\n", array('','','','','') )."'),

		('x', '900'),
		('y', '300'),
		('thumb_x', '250'),
		('thumb_y', '75'),
		('ava_x', '100'),
		('ava_y', '100'),
		('blog_x', '190'),
		('blog_y', '100')
		

	") or footer(mysql_error()); echo "Done <br />";





////////////////////////////////////////////////////////////////////////////////////////////////
	echo "Inserting data into '{$my_prefix}users'...  "; 
	
	$salt=mt_rand(0,99999999990000);
	@mysql_query("INSERT INTO `{$my_prefix}users` 
		(`level`,`login`,`pass`,`algo`,`salt`,`name`,`email`,`date`)
		
	VALUES(
		'3',
		'".mysql_real_escape_string($_POST['admin_id'])."',	
		'".sha1($salt.$_POST['admin_pass'])."',
		'sha1',
		'$salt',
		'Administrator',
		'',
		'".time()."')"
		
	) or footer(mysql_error()); echo "Done <br />";







 }
//end	 $_POST['ow'] //admin email todo
?>