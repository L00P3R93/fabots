<?php
session_start();
date_default_timezone_set('Africa/Nairobi');
use BOTS\Models\Db;
use BOTS\Models\User;
use BOTS\Models\Util;
use BOTS\Models\Cart;
use BOTS\Models\Order;
use BOTS\Models\Product;

define('BOTS_NAMESPACE','BOTS');
define('BOTS_DIR_ROOT', dirname(__FILE__));
define('BOTS_DIR_COMPONENTS', BOTS_DIR_ROOT.'/components');
define('BOTS_DIR_CONTROLLERS',BOTS_DIR_ROOT.'/controllers');
define('BOTS_DIR_MODELS', BOTS_DIR_ROOT.'/models');
define('BOTS_DIR_UPLOADS', BOTS_DIR_ROOT.'/uploads');

require BOTS_DIR_MODELS.'/Db.php';
require BOTS_DIR_MODELS.'/Util.php';
require BOTS_DIR_MODELS.'/User.php';
require BOTS_DIR_MODELS.'/Cart.php';
require BOTS_DIR_MODELS.'/Order.php';
require BOTS_DIR_MODELS.'/Product.php';


$config = array(
    'database_name'=>'fabots',
    'database_host'=>'localhost',
    /**Live*/
    //'database_user'=>'sntaksme_sntaks',
    //'database_password'=>'V4J89wYyfLqMBMY',
    /**LocalHost */
    'database_user'=>'root',
    'database_password'=>'',
    'cors'=>[
        'enabled'=>true,
        'origin'=>'*',
        'headers'=>[
            'Access-Control-Allow-Headers'=>'Origin, X-Requested-With, Authorization, Cache-Control, Content-Type, Access-Control-Allow-Origin',
            'Access-Control-Allow-Credentials'=>'true',
            'Access-Control-Allow-Methods'=>'GET,PUT,POST,DELETE,OPTIONS,PATCH'
        ]
    ]
);

define('_DB_SERVER_', $config['database_host']);
define('_DB_NAME_', $config['database_name']);
define('_DB_USER_', $config['database_user']);
define('_DB_PASSWD_', $config['database_password']);
define('BOTS_NO', 1192);
define('ADMIN_MAIL', 'admin@your-server.com');
define('FULL_DATE', date('Y-m-d H:i:s'));
define('NOW_', date('Y-m-d H:i:s'));
define('DATE_', date('Y-m-d'));
define('YEAR_', date('Y'));
define('MONTH_', date('m'));
define('DAY_', date('d'));

$DB = new Db();
$UT = new Util();
$U = new User();
$cart = new Cart();
$order = new Order();
$P = new Product();

if(isset($_SESSION['bots_'])){
    $user_id = $UT::decurl($_SESSION['bots_']);
    $user_email = $DB::get_value('users',"uid='$user_id'","email");
    $user_names = $U->get_user_names($_SESSION['bots_']);
    $user = $U->get_user($user_id);
}

$page = $UT::get_title_page();
