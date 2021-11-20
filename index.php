<?php
const DS = DIRECTORY_SEPARATOR;
define('DOMAIN', "http://127.0.0.1/casa/");
define('TITLE', "Colive | London Letting Company");
define('APP', dirname(__DIR__) . DS . "casa" . DS . "App" . DS);
define('DATA', dirname(__DIR__) . DS . "casa" . DS . "data" . DS);
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'colivebase');
define('DB_USER', 'root');
define('DB_PASS', '');

include 'route.php';

//Libraries
include APP . 'lib/Model.php';

//Hanlders
include APP . 'src/ErrorHandle.php';

//Controllers
include APP . 'src/Home.php';
include APP . 'src/Auth.php';
include APP . 'src/Dashboard.php';

$route = new Route();
$route->add('/', 'Home', '');
$route->add('/home', 'Home', '');
$route->add('/about', 'Home', 'about');
$route->add('/housing', 'Home', 'housing');
$route->add('/property', 'Home', 'property');
$route->add('/contact', 'Home', 'contact');

$route->add('/login', 'Auth', 'login');
$route->add('/login/forgotpwd', 'Auth', 'ForgotPassword');
$route->add('/login/reset', 'Auth', 'ResetPassword');
$route->add('/logout', 'Auth', 'logout');

$route->add('/admin', 'Dashboard', '');
$route->add('/admin/uploads', 'Dashboard', 'Imageuploads');
$route->add('/admin/saveimage', 'Dashboard', 'Saveuploads');
$route->add('/admin/saveabtimage', 'Dashboard', 'SaveAbtuploads');
$route->add('/admin/saveslide', 'Dashboard', 'Saveslideupload');
$route->add('/admin/home', 'Dashboard', '');
$route->add('/admin/home/newuser', 'Dashboard', 'newAccount');
$route->add('/admin/home/changepwd', 'Dashboard', 'ChangePwdAccount');
$route->add('/admin/home/remuser', 'Dashboard', 'RemoveAccount');
$route->add('/admin/homepage/savedata', 'Dashboard', 'save_homedata');
$route->add('/admin/testpage', 'Dashboard', 'testpage');
$route->add('/admin/homepage', 'Dashboard', 'homepage');
$route->add('/admin/aboutpage', 'Dashboard', 'aboutpage');
$route->add('/admin/company', 'Dashboard', 'company');
$route->add('/admin/company/newstaff', 'Dashboard', 'newstaff');
$route->add('/admin/company/remstaff', 'Dashboard', 'remvstaff');
$route->add('/admin/housing', 'Dashboard', 'housing');
$route->add('/admin/housing/newhouse', 'Dashboard', 'newhouse');
$route->add('/admin/housing/remhouse', 'Dashboard', 'remvhouse');
$route->submit();

?>