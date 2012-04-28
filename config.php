<?php
switch($_SERVER['SERVER_NAME']) {
	case 'localhost':
	case 'amalthea':
	case 'stockpyle.amalthea':
		define('MYSQL_HOSTNAME', "localhost");
		define('MYSQL_USERNAME', "mysql-user");
		define('MYSQL_PASSWORD', "mysql-pass");
		define('MYSQL_DATABASE', "stockpyle");
		break;
	case 'stockpyle.net':
	case 'www.stockpyle.net':
		define('MYSQL_HOSTNAME', "mysql-host");
		define('MYSQL_USERNAME', "mysql-user");
		define('MYSQL_PASSWORD', "mysql-pass");
		define('MYSQL_DATABASE', "stockpyle");
		break;
	default:
		die("INVALID HOST");
}
