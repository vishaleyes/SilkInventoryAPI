<?php

	//date_default_timezone_set('Australia/Perth');
	
	define('DEFAULT_CONTROLLER',"api");
	define('DEFAULT_ACTION',"index");
	define('DEFAULT_LANGUAGE',"eng");
	define('DEFAULT_THEME',1);
	
	define('WEATHER_NORMAL_MIN',67);
	define('WEATHER_NORMAL_MAX',80);
	
	define('WEATHER_COLD_MIN',0);
	define('WEATHER_COLD_MAX',66);

	define('WEATHER_WARM_MIN',80);
	define('WEATHER_WARM_MAX',200);
	
	define('DESCREASE_VALUE_FOR_CELSIUS',459.67);


	// charset for web pages and emails

	$basepath = str_replace("\\","/",dirname(dirname(__FILE__)));
	$basepath .= "/";
	
	//Site name info
	define('BASEPATH',  $basepath);
	define("_SITENAME_",'silkinventory');
	define("_SITENAME_NO_CAPS_",'silkinventory');
	define("_SITENAME_CAPS_",'silkinventory');

	$is_live = true;  // for live dfault
	
	if(isset($_SERVER['SERVER_NAME'])) {
		if($_SERVER['SERVER_NAME'] == "localhost") {
			$is_live = false;  //false is for local		
		}
	}
	$baseUrl="";
	if($is_live)
	{
				//Local
		  define('WEB_HOST_NAME','silkinventory.com');
		  define('SITE_NAME','silkinventory');
		  $baseUrl.=WEB_HOST_NAME.'/silkinventory';	
		  define('FILE_UPLOAD', '/home/silkinventory/www/silkinventory/assets/upload/');
		  define('FILE_PATH','/home/silkinventory/www/silkinventory/');
		  define('DEFAULT_FILE_PATH','/home/silkinventory/www/silkinventory/');
		  define('LOGS_PATH','/home/silkinventory/www/dlogs/');
		  define('DB_SERVER', 'localhost');
		  define('DB_SERVER_USERNAME', 'silkinve_bypt');
		  define('DB_SERVER_PASSWORD', 'Bypt@2012');
		  define('DB_DATABASE', 'silkinve_silkinventory');
		  define('MAIL_SERVER_FROMNAME', 'no-reply@silkinventory.com');
		  define('MAIL_SERVER', 'silkinventory.com');
		  define('MAIL_SERVER_USERNAME', 'no-reply');
		  define('MAIL_SERVER_PASSWORD', 'nor373');
		  define('MAIL_SERVER_PORT_DEFAULT', true);
		  define('MAIL_SERVER_SMTP_SECURE', false);
		  define('MAIL_SERVER_SMTP_AUTH', false);
		  define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/');		  
		  define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/m/');
		  define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/');
		  define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/');
		  define('DOMAIN_NAME', 'silkinventory.com');
		  define('SMS_NUMBER', '');
	      define('USE_SOLR', 'true'); // false -> no, true -> yes
		  define('ADMIN_EMAIL','vpanchal911@gmail.com');
		  define('API_KEY_GOOGLE_MAP','ABQIAAAAGadnb68hworsU9g2Ph1YBRQtlEzpQNiw_VFD179wQexLmE_W-xSNBeBdeZKJg37poRNks4BNN4lExQ');	
		
	}
	else
	{
	
		//Local
		define('WEB_HOST_NAME','localhost');
		define('SITE_NAME','silkinventory');
		$baseUrl.=WEB_HOST_NAME.'/silkinventory';	
		$filename="E:/wamp/www/silkinventory";
		if (file_exists($filename)) {
			
			define('FILE_UPLOAD', 'E:/wamp/www/silkinventory/assets/upload/');
			define('FILE_PATH','E:/wamp/www/silkinventory/');
			define('LOGS_PATH','E:/wamp/www/silkinventory/dlogs/');
		  	define('DEFAULT_FILE_PATH','E:/wamp/www/silkinventory/');
		}
		else
		{
			define('FILE_UPLOAD', 'D:/wamp/www/silkinventory/assets/upload/');
			define('FILE_PATH','D:/wamp/www/silkinventory/');
			define('LOGS_PATH','D:/wamp/www/silkinventory/dlogs/');
		  	define('DEFAULT_FILE_PATH','D:/wamp/www/silkinventory/');
		}
		
		// Data base
		define('DB_SERVER', 'byptserver');
		define('DB_SERVER_USERNAME', 'bypt');
		define('DB_SERVER_PASSWORD', 'Bypt@2012');
		define('DB_DATABASE', 'clothapp');
		define('MAIL_SERVER', 'smtp.gmail.com');
		define('MAIL_SERVER_FROMNAME', 'no-reply@'._SITENAME_NO_CAPS_.'.com');
		define('MAIL_SERVER_USERNAME', 'info@silkinventory.com');
		define('MAIL_SERVER_PASSWORD', '123456');
		define('MAIL_SERVER_PORT_DEFAULT', false);
		define('MAIL_SERVER_SMTP_SECURE', true);
		define('MAIL_SERVER_SMTP_AUTH', true);
		define('SMS_NUMBER', '9724882220');
		define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/m/');
		define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('USE_SOLR', 'false');
		define('ADMIN_EMAIL','vpanchal911@gmail.com');
		define('API_KEY_GOOGLE_MAP','ABQIAAAAoKEOVeH5Ak8SaEmM-hRytBRSYwPj9khfICxBbljTfsfiJS8R_BRzFQ9tZSd52bOGUKRQru8MIcs0aA');
	}
	
	define('ENCRIPT_KEY','test123');
	/////////////////////////////////////////////////
	define('MAIL_FROM_NAME',_SITENAME_.'.com');
	define('MAIL_FROM','no-reply@'._SITENAME_NO_CAPS_.'.com');
	
	define('DB_TYPE', 'mysql');
	define('DB_PREFIX', '');
	
	define('USE_PCONNECT', 'false');		
	define('STORE_SESSIONS', 'db');
	define('SQL_CACHE_METHOD', 'none'); 
	
	define('PAGINATE_LIMIT', '5');
	define('ADMIN_PAGINATE_LIMIT', '10');
	define('SEEKER_PAGINATE_LIMIT', '6');
	define('RECENT_ACTIVITY_PAGINATE_LIMIT', '10');
	define('LIMIT_10', '10');
	
	//For rest Api
	define("REST_REQUEST_STATUS",200);
	// for check authorize 
	
	//Allow image extention
	$extArray=array('jpg','jpeg','png','gif','GIF','PNG','JPEG','JPG');
	define("IMAGE_EXT",serialize($extArray));
	//Allow file extention
	$fileExtNotAllowArray=array('php','exe');
	define("FILE_NOT_EXT",serialize($fileExtNotAllowArray));
	
	
	//Register Link Expiry Time
	define("ACTIVATION_LINK_EXPIRY_TIME",3 * 24 * 60 * 60);// 3 days; 24 hours; 60 mins; 60secs
	
	//Api Link Expiry Time
	define("API_LINK_EXPIRY_TIME",2*60*60);
	$NOT_ALLOW_CHAR=array('<','>','[',']','{','}','|','%','/','/\/','~','#','^');
	define("NOT_ALLOW_CHAR",serialize($NOT_ALLOW_CHAR));
	ini_set('memory_limit', '-1');