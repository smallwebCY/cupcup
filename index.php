<?php
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
date_default_timezone_set('Asia/Shanghai');
/*初始化环境*/

define('PDO','sqlite:./sql/sql.db');
define('ROOT',__DIR__);
include_once(ROOT.'/lib/start.php');

include_once(ROOT.'/lib/route.php');


$m = isset($_GET['m']) ? $_GET['m'] : 'index';
$c = isset($_GET['c']) ? $_GET['c'] : 'index';
$a = isset($_GET['a']) ? $_GET['a'] : 'index';


include_once(ROOT.'/app/'.$m.'.php');
$class= "\app\\$c";
$controller = new $class;
echo $controller -> $a();
