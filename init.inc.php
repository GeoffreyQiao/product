<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
header( 'Content-Type:text/html;charset=utf-8' );

date_default_timezone_set('PRC');

define( 'DS', DIRECTORY_SEPARATOR );

define( 'ROOT', __DIR__ . DS );

//模板目录
define( 'TPL', ROOT . 'templates' . DS );

//编译文件目录
define( 'TPL_C', ROOT . 'templates_c' . DS );

//静态页面缓存文件目录
define( 'CACHE', ROOT . 'cache' . DS );


spl_autoload_register('autoload');
function autoload($name){
    $classname = strtolower(substr($name,-3));

    switch ($classname) {
        case 'mod':
            require ROOT . 'Models/' . $name . '.php';
            break;

        case 'vew':
            require ROOT . 'Views/' . $name . '.php';
            break;

        case 'con':
            require ROOT . 'Controllers/' . $name . '.php';
            break;

        default:
            require ROOT . 'Includes/' . $name . '.class.php';
            break;
    }
}
